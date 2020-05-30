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
 * @module      Aislan Movie Catalog
 * @category    Aislan
 * @package     Aislan_MovieCatalog
 *
 * @copyright   Copyright (c) 2020 Aislan.
 *
 * @author      Aislan Core Team <aislan.cedraz@gmail.com.br>
 */

declare(strict_types=1);

namespace Aislan\SalesIntegration\Console\Command;

use Aislan\SalesIntegration\Api\Data\CustomerApiInterface;
use Aislan\SalesIntegration\Api\Data\CustomerApiInterfaceFactory;
use Aislan\SalesIntegration\Api\OrderApiInterface;
use Aislan\SalesIntegration\Api\OrderApiInterfaceFactory;
use Aislan\SalesIntegration\Helper\Config;
use Aislan\SalesIntegration\Model\CustomerApi;
use DateTime;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Data\Customer;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Webapi\ServiceOutputProcessor;
use Magento\Sales\Api\Data\OrderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Update Movies
 */
class SalesIntegration extends Command
{
    /**
     * @var OrderInterface
     */
    private $_order;
    /**
     * @var CustomerApiInterface
     */
    private $customerApi;
    /**
     * @var OrderApiInterface
     */
    private $orderApi;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var TimezoneInterface
     */
    private $timezone;
    /**
     * @var \Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface
     */
    private $shippingAddressApi;
    /**
     * @var ServiceOutputProcessor
     */
    private $_serviceOutputProcessor;

    /**
     * GenerateIndex constructor.
     * @param string|null $name
     * @param OrderInterface $_order
     */
    public function __construct(
        string $name = null,
        OrderInterface $_order,
        CustomerApiInterface $customerApi,
        OrderApiInterface $orderApi,
        CustomerRepositoryInterface $customerRepository,
        TimezoneInterface $timezone,
        \Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface $shippingAddressApi,
        ServiceOutputProcessor $_serviceOutputProcessor
    ) {
        parent::__construct($name);
        $this->_order = $_order;
        $this->customerApi = $customerApi;
        $this->orderApi = $orderApi;
        $this->customerRepository = $customerRepository;
        $this->timezone = $timezone;
        $this->shippingAddressApi = $shippingAddressApi;
        $this->_serviceOutputProcessor = $_serviceOutputProcessor;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('sales:integration')
            ->setDescription('Teste Request in Sales integration');
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $incrementId = 000000002;
        $order = $this->_order->loadByIncrementId($incrementId);
        $orderApi = $this->_serviceOutputProcessor->convertValue($this->orderApi->getOrderApiByOrder($order),Config::AISLAN_SALESINTEGRATION_API_DATA_ORDERAPIINTERFACE);
        $orderApi = json_encode($orderApi);
    }
}
