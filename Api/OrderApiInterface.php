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

namespace Aislan\SalesIntegration\Api;

use Aislan\SalesIntegration\Api\Data\CustomerApiInterface;
use Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * Interface OrderApiInterface
 * @api
 */
interface OrderApiInterface
{
    /**
     * @param \Aislan\SalesIntegration\Api\Data\ustomerApiInterface $customerApi
     * @return mixed
     */
    public function setCustomer(CustomerApiInterface $customerApi);

    /**
     * @return \Aislan\SalesIntegration\Api\Data\CustomerApiInterface
     */
    public function getCustomer() : CustomerApiInterface;

    /**
     * @param \Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface $shippingAddress
     * @return mixed
     */
    public function setShippingAddress(ShippingAddressApiInterface $shippingAddress);

    /**
     * @return \Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface
     */
    public function getShippingAddress() : ShippingAddressApiInterface;

    /**
     * @param array $items
     * @return array[]
     */
    public function setItems($items);

    /**
     * @return \Aislan\SalesIntegration\Api\Data\ItemApiInterface[]
     */
    public function getItems();

    /**
     * @param $shippingMethod
     * @return mixed
     */
    public function setShippingMethod($shippingMethod);

    /**
     * @return string
     */
    public function getShippingMethod() : string;

    /**
     * @param $paymentMethod
     * @return mixed
     */
    public function setPaymentMethod($paymentMethod);

    /**
     * @return string
     */
    public function getPaymentMethod() : string;

    /**
     * @param $paymentInstallments
     * @return mixed
     */
    public function setPaymentInstallments($paymentInstallments);

    /**
     * @return int
     */
    public function getPaymentInstallments() : int;

    /**
     * @param $subtotal
     * @return mixed
     */
    public function setSubtotal($subtotal);

    /**
     * @return mixed
     */
    public function getSubtotal();

    /**
     * @param $shippingAmount
     * @return mixed
     */
    public function setShippingAmount($shippingAmount);

    /**
     * @return mixed
     */
    public function getShippingAmount();

    /**
     * @param $discount
     * @return mixed
     */
    public function setDiscount($discount);

    /**
     * @return mixed
     */
    public function getDiscount();

    /**
     * @param $total
     * @return mixed
     */
    public function setTotal($total);

    /**
     * @return mixed
     */
    public function getTotal();

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @return \Aislan\SalesIntegration\Model\OrderApi
     */
    public function getOrderApiByOrder(OrderInterface $order);
}
