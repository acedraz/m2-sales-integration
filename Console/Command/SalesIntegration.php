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

namespace Aislan\SalesIntegration\Console\Command;

use Aislan\SalesIntegration\Helper\Config;
use Aislan\SalesIntegration\Api\Service\ApiServiceInterfaceFactory;
use Aislan\SalesIntegration\Helper\System;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Framework\Webapi\ServiceOutputProcessor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Aislan\SalesIntegration\Api\OrderApiInterface;

/**
 * Class SalesIntegration
 */
class SalesIntegration extends Command
{
    const ORDER_INCREMENT_ID = 'orderIncrementId';

    /**
     * @var OrderInterface
     */
    private $_order;

    /**
     * @var ApiServiceInterfaceFactory
     */
    private $apiServiceFactory;

    /**
     * @var ServiceOutputProcessor
     */
    private $_serviceOutputProcessor;

    /**
     * @var OrderApiInterface
     */
    private $orderApi;
    /**
     * @var System
     */
    private $system;

    /**
     * GenerateIndex constructor.
     * @param string|null $name
     * @param OrderInterface $_order
     * @param ApiServiceInterfaceFactory $apiServiceFactory
     * @param ServiceOutputProcessor $_serviceOutputProcessor
     * @param OrderApiInterface $orderApi
     */
    public function __construct(
        string $name = null,
        OrderInterface $_order,
        ApiServiceInterfaceFactory $apiServiceFactory,
        ServiceOutputProcessor $_serviceOutputProcessor,
        OrderApiInterface $orderApi,
        System $system
    ) {
        parent::__construct($name);
        $this->_order = $_order;
        $this->apiServiceFactory = $apiServiceFactory;
        $this->_serviceOutputProcessor = $_serviceOutputProcessor;
        $this->orderApi = $orderApi;
        $this->system = $system;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('sales:integration')
            ->setDescription('Send order to ERP API');
        $this->addArgument(self::ORDER_INCREMENT_ID, InputArgument::REQUIRED, __('Type a increment id order: '));
        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->system->isEnabled()) {
            $message = __('Disabled module. Please enable module in admin store settings painel.');
            $output->writeln('<error>' . $message . '<error>');
            return;
        }
        $message = __('Executing');
        $output->writeln('<info>' . $message . '<info>');
        try {
            $order = $this->_order->loadByIncrementId($input->getArgument(self::ORDER_INCREMENT_ID));
        } catch (\Exception $e) {
            $message = __('Error in get order: %1',$e);
            $output->writeln('<error>' . $message . '<error>');
            return;
        }
        try {
            $orderApi = $this->_serviceOutputProcessor->convertValue($this->orderApi->getOrderApiByOrder($order),Config::AISLAN_SALESINTEGRATION_API_DATA_ORDERAPIINTERFACE);
            $orderApi = json_encode($orderApi);
        } catch (\Exception $e) {
            $message = __('Error in convert order: %1',$e);
            $output->writeln('<error>' . $message . '<error>');
            return;
        }
        try {
            $apiService = $this->apiServiceFactory->create();
            $apiService->setData($orderApi);
            if ($apiService->execute()  === false) {
                $message = __('Error in send order');
                $output->writeln('<error>' . $message . '<error>');
                return;
            }
        } catch (\Exception $e) {
            $message = __('Error in send order: %1',$e);
            $output->writeln('<error>' . $message . '<error>');
            return;
        }
        $message = __('Success');
        $output->writeln('<info>' . $message . '<info>');
    }
}
