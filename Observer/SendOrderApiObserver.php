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

namespace Aislan\SalesIntegration\Observer;

use Aislan\SalesIntegration\Api\OrderApiInterface;
use Aislan\SalesIntegration\Api\Service\ApiServiceInterfaceFactory;
use Aislan\SalesIntegration\Helper\Config;
use Aislan\SalesIntegration\Helper\System;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Webapi\ServiceOutputProcessor;
use Psr\Log\LoggerInterface;

/**
 * Class SendOrderApiObserver
 */
class SendOrderApiObserver implements ObserverInterface
{
    /**
     * @var ApiServiceInterface
     */
    private $apiServiceFactory;

    /**
     * @var System
     */
    private $system;

    /**
     * @var LoggerInterface
     */
    private $_logger;

    /**
     * @var OrderApiInterface
     */
    private $orderApi;

    /**
     * @var ServiceOutputProcessor
     */
    private $_serviceOutputProcessor;

    /**
     * SendOrderApiObserver constructor.
     * @param ApiServiceInterfaceFactory $apiServiceFactory
     * @param OrderApiInterface $orderApi
     * @param System $system
     * @param LoggerInterface $_logger
     * @param ServiceOutputProcessor $_serviceOutputProcessor
     */
    public function __construct(
        ApiServiceInterfaceFactory $apiServiceFactory,
        OrderApiInterface $orderApi,
        System $system,
        LoggerInterface $_logger,
        ServiceOutputProcessor $_serviceOutputProcessor
    ) {

        $this->apiServiceFactory = $apiServiceFactory;
        $this->system = $system;
        $this->_logger = $_logger;
        $this->orderApi = $orderApi;
        $this->_serviceOutputProcessor = $_serviceOutputProcessor;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if (!$this->system->isEnabled()) {
            return $this;
        }
        $order = $observer->getEvent()->getOrder();
        try {
            $orderApi = $this->_serviceOutputProcessor->convertValue($this->orderApi->getOrderApiByOrder($order),Config::AISLAN_SALESINTEGRATION_API_DATA_ORDERAPIINTERFACE);
            $orderApi = json_encode($orderApi);
        } catch (\Exception $e) {
            $message = __('Error in convert order: %1',$e);
            $this->_logger->critical($message);
            return $this;
        }
        try {
            $apiService = $this->apiServiceFactory->create();
            $apiService->setData($orderApi);
            if ($apiService->execute() === false) {
                return $this;
            }
        } catch (\Exception $e) {
            $message = __('Error in send order: %1',$e);
            $this->_logger->critical($message);
            return $this;
        }
        $message = __('Order: %1 sended to ERP',$order->getIncrementId());
        $this->_logger->info($message);
        return $this;
    }
}
