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

namespace Aislan\SalesIntegration\Api\Data;

use Magento\Sales\Api\Data\OrderAddressInterface;

/**
 * Interface ShippingAddressApiInterface
 * @api
 */
interface ShippingAddressApiInterface
{
    /**
     * @param $street
     * @return mixed
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getStreet() : string;

    /**
     * @param $number
     * @return mixed
     */
    public function setNumber($number);

    /**
     * @return int
     */
    public function getNumber() : int;

    /**
     * @param $additional
     * @return mixed
     */
    public function setAdditional($additional);

    /**
     * @return string
     */
    public function getAdditional() : string;

    /**
     * @param $neighborhood
     * @return mixed
     */
    public function setNeighborhood($neighborhood);

    /**
     * @return string
     */
    public function getNeighborhood() : string;

    /**
     * @param $city
     * @return mixed
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getCity() : string;

    /**
     * @param $cityIbgeCode
     * @return mixed
     */
    public function setCityIbgeCode($cityIbgeCode);

    /**
     * @return int
     */
    public function getCityIbgeCode() : int;

    /**
     * @param $uf
     * @return mixed
     */
    public function setUf($uf);

    /**
     * @return string
     */
    public function getUf() : string;

    /**
     * @param $country
     * @return mixed
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getCountry() : string;

    /**
     * @param OrderAddressInterface $address
     * @return mixed
     */
    public function getShippingAddressApiByAddress(OrderAddressInterface $address);
}
