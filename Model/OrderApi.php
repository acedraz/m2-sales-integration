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

namespace Aislan\SalesIntegration\Model;

use Aislan\SalesIntegration\Api\Data\CustomerApiInterface;
use Aislan\SalesIntegration\Api\Data\ItemApiInterfaceFactory;
use Aislan\SalesIntegration\Api\OrderApiInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * Class OrderApi
 */
class OrderApi extends AbstractModel implements OrderApiInterface
{

    const CUSTOMER = 'customer';
    const SHIPPING_ADDRESS = 'shipping_address';
    const ITEMS = 'items';
    const SHIPPING_METHOD = 'shipping_method';
    const PAYMENT_METHOD = 'payment_method';
    const PAYMENT_INSTALLMENTS = 'payment_installments';
    const SUBTOTAL = 'subtotal';
    const SHIPPING_AMOUNT = 'shipping_amount';
    const DISCOUNT = 'discount';
    const TOTAL = 'total';

    /**
     * @var ItemApiInterfaceFactory
     */
    private $itemApiFactory;

    /**
     * @var CustomerRepositoryInterface
     */
    private $_customerRepository;

    /**
     * @var CustomerApiInterface
     */
    private $customerApi;
    /**
     * @var ShippingAddressApiInterface
     */
    private $shippingAddressApi;

    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [],
        ItemApiInterfaceFactory $itemApiFactory,
        CustomerRepositoryInterface $_customerRepository,
        CustomerApiInterface $customerApi,
        ShippingAddressApiInterface $shippingAddressApi
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->itemApiFactory = $itemApiFactory;
        $this->_customerRepository = $_customerRepository;
        $this->customerApi = $customerApi;
        $this->shippingAddressApi = $shippingAddressApi;
    }

    /**
     * @param \Aislan\SalesIntegration\Api\Data\CustomerApiInterface $customerApi
     * @return mixed|void
     */
    public function setCustomer(CustomerApiInterface $customerApi)
    {
        $this->setData(self::CUSTOMER,$customerApi);
    }

    /**
     * @return \Aislan\SalesIntegration\Api\Data\CustomerApiInterface
     */
    public function getCustomer() : CustomerApiInterface
    {
        return $this->getData(self::CUSTOMER);
    }

    /**
     * @param ShippingAddressApiInterface $shippingAddress
     * @return mixed|void
     */
    public function setShippingAddress(ShippingAddressApiInterface $shippingAddress)
    {
        $this->setData(self::SHIPPING_ADDRESS,$shippingAddress);
    }

    /**
     * @return ShippingAddressApiInterface
     */
    public function getShippingAddress() : ShippingAddressApiInterface
    {
        return $this->getData(self::SHIPPING_ADDRESS);
    }

    /**
     * @param $items
     * @return mixed|void
     */
    public function setItems($items)
    {
        foreach ($items as $item) {
            $itemApi = $this->itemApiFactory->create()->getItemApiByItem($item);
            $itemsApi[] = $itemApi;
        }
        $this->setData(self::ITEMS,$itemsApi);
    }

    /**
     * @return array|mixed|null
     */
    public function getItems()
    {
        return $this->getData(self::ITEMS);
    }

    /**
     * @param $shippingMethod
     * @return mixed|void
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->setData(self::SHIPPING_METHOD,$shippingMethod);
    }

    /**
     * @return string
     */
    public function getShippingMethod(): string
    {
        return (string)$this->getData(self::SHIPPING_METHOD);
    }

    /**
     * @param $paymentMethod
     * @return mixed|void
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->setData(self::PAYMENT_METHOD,$paymentMethod);
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return (string)$this->getData(self::SHIPPING_METHOD);
    }

    /**
     * @param $paymentInstallments
     * @return mixed|void
     */
    public function setPaymentInstallments($paymentInstallments)
    {
        $this->setData(self::PAYMENT_INSTALLMENTS,$paymentInstallments);
    }

    /**
     * @return int
     */
    public function getPaymentInstallments(): int
    {
        return (int)$this->getData(self::PAYMENT_INSTALLMENTS);
    }

    /**
     * @param $subtotal
     * @return mixed|void
     */
    public function setSubtotal($subtotal)
    {
        $this->setData(self::SUBTOTAL,$subtotal);
    }

    /**
     * @return array|mixed|null
     */
    public function getSubtotal()
    {
        return $this->getData(self::SUBTOTAL);
    }

    /**
     * @param $shippingAmount
     * @return mixed|void
     */
    public function setShippingAmount($shippingAmount)
    {
        $this->setData(self::SHIPPING_AMOUNT,$shippingAmount);
    }

    /**
     * @return array|mixed|null
     */
    public function getShippingAmount()
    {
        return $this->getData(self::SHIPPING_AMOUNT);
    }

    /**
     * @param $discount
     * @return mixed|void
     */
    public function setDiscount($discount)
    {
        $this->setData(self::DISCOUNT,$discount);
    }

    /**
     * @return array|mixed|null
     */
    public function getDiscount()
    {
        return $this->getData(self::DISCOUNT);
    }

    /**
     * @param $total
     * @return mixed|void
     */
    public function setTotal($total)
    {
        $this->setData(self::TOTAL,$total);
    }

    /**
     * @return array|mixed|null
     */
    public function getTotal()
    {
        return $this->getData(self::TOTAL);
    }

    /**
     * @param OrderInterface $order
     * @return $this|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrderApiByOrder(OrderInterface $order)
    {
        $customer = $this->_customerRepository->getById($order->getCustomerId());
        $this->setCustomer($this->customerApi->getCustomerApiByCustomer($customer));
        $this->setShippingAddress($this->shippingAddressApi->getShippingAddressApiByAddress($order->getShippingAddress()));
        $this->setItems($order->getAllVisibleItems());
        $this->setShippingMethod($order->getShippingDescription());
        $this->setPaymentMethod($order->getPayment()->getMethod());
        $this->setPaymentInstallments(method_exists($order->getExtensionAttributes(),'getPaymentInstallments') ? $order->getExtensionAttributes()->getPaymentInstallments() : '0');
        $this->setSubtotal($order->getSubtotal());
        $this->setShippingAmount($order->getShippingAmount());
        $this->setDiscount($order->getDiscountInvoiced());
        $this->setTotal($order->getTotalInvoiced());
        return $this;
    }
}
