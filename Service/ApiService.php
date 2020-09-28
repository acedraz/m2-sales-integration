<?php
/**
 * Aislan
 *
 * NOTICE OF LICENSE
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to aislan.cedraz@gmail.com.br for more information.
 *
 * @module      Aislan Sales Integration
 * @category    Aislan
 * @package     Aislan_SalesIntegration
 *
 * @copyright   Copyright (c) 2020 Aislan.
 *
 * @author      Aislan Core Team <aislan.cedraz@gmail.com.br>
 */

declare(strict_types=1);

namespace Aislan\SalesIntegration\Service;

use Aislan\SalesIntegration\Api\Service\ApiServiceInterface;
use Aislan\SalesIntegration\Api\SystemInterface;
use Aislan\SalesIntegration\Model\Config;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Webapi\Rest\Request;
use Aislan\SalesIntegration\Api\LoggerInterface;

/**
 * Class ApiService
 */
class ApiService implements ApiServiceInterface
{
    const ERP_ENDPOINT = '/webhook/sales';

    /**
     * @var string
     */
    private $apiRequestUri;

    /**
     * @var string
     */
    private $apiRequestKey;

    /**
     * @var string
     */
    private $apiRequestEndpoint;

    /**
     * @var int
     */
    private $apiAttempts;

    /**
     * @var ClientFactory
     */
    private $_clientFactory;

    /**
     * @var ResponseFactory
     */
    private $_responseFactory;

    /**
     * @var System
     */
    private $system;

    /**
     * @var LoggerInterface
     */
    private $_logger;

    /**
     * @var Json
     */
    private $data;
    /**
     * @var ManagerInterface
     */
    private $_eventManager;

    /**
     * TMDApiService constructor.
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     * @param System $system
     * @param LoggerInterface $_logger
     * @param ManagerInterface $_eventManager
     */
    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory,
        SystemInterface $system,
        LoggerInterface $_logger,
        ManagerInterface $_eventManager
    ) {
        $this->_clientFactory = $clientFactory;
        $this->_responseFactory = $responseFactory;
        $this->system = $system;
        $this->apiRequestUri = $this->system->getApiUrl();
        $this->apiRequestKey = $this->system->getApiKey();
        $this->apiAttempts = $this->system->getApiAttempts();
        $this->apiRequestEndpoint = self::ERP_ENDPOINT;
        if ($this->system->getErpEndpoint()) {
            $this->apiRequestEndpoint = $this->system->getErpEndpoint();
        }
        $this->_logger = $_logger;
        $this->_eventManager = $_eventManager;
    }

    /**
     * Do API request with provided params
     *
     * @param string $uriEndpoint
     * @param array $params
     * @param string $requestMethod
     *
     * @return Response
     */
    private function doRequest(
        string $uriEndpoint,
        array $params = [],
        string $requestMethod = Request::HTTP_METHOD_POST
    ): Response {
        try {
            $client = $this->_clientFactory->create();
            $response = $client->request(
                $requestMethod,
                $this->apiRequestUri.$uriEndpoint,
                $params
            );
        } catch (GuzzleException $exception) {
            $response = $this->_responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }
        return $response;
    }

    /**
     * Send data for API
     */
    public function execute()
    {
        $params = [
            RequestOptions::HEADERS => [
                Config::AUTHORIZATION => Config::BEARER . ' '. $this->apiRequestKey,
                Config::ACCEPT => Config::APPLICATION_JSON,
                Config::CONTENT_TYPE => Config::APPLICATION_JSON
            ],
            RequestOptions::BODY => $this->data
        ];
        $attempts = 0;
        $this->_eventManager->dispatch(
            'request_api_erp_send_before',
            [
                'endpoint' => $this->apiRequestEndpoint,
                'params' => $params,
                'api_key' => $this->apiRequestKey,
                'attempts' => $attempts,
                'uri' => $this->apiRequestUri,
                'data' => $this->data
            ]
        );
        do {
            $response = $this->doRequest($this->apiRequestEndpoint,$params);
            $status = $response->getStatusCode();
            $attempts++;
        } while ((int)$status != 200 && $attempts < $this->apiAttempts);
        if ($status != 200)
        {
            $this->_logger->critical(Config::ERROR_API_REQUEST . $status . ' - ' . $response->getReasonPhrase());
            return false;
        }
        $this->_eventManager->dispatch(
            'request_api_erp_send_after',
            [
                'status' => $status,
                'response' => $response,
                'content' => $response->getBody()->getContents()
            ]
        );
        return $response->getBody()->getContents();
    }

    /**
     * @param $endpoint
     */
    public function setRequestEndpoint($endpoint)
    {
        $this->apiRequestEndpoint = $endpoint;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }
}
