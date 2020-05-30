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

use Aislan\SalesIntegration\Api\Data\ShippingAddressApiInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Sales\Api\Data\OrderAddressInterface;

/**
 * Class AddressApi
 */
class ShippingAddressApi extends AbstractModel implements ShippingAddressApiInterface
{

    const STREET = 'street';
    const NUMBER = 'number';
    const ADDITIONAL = 'additional';
    const NEIGHBORHOOD = 'neighborhood';
    const CITY = 'city';
    const CITY_IBGE_CODE = 'city_ibge_code';
    const UF = 'uf';
    const COUNTRY = 'country';

    /**
     * @param $street
     * @return mixed|void
     */
    public function setStreet($street)
    {
        $this->setData(self::STREET,$street);
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return (string)$this->getData(self::STREET);
    }

    /**
     * @param $number
     * @return mixed|void
     */
    public function setNumber($number)
    {
        $this->setData(self::NUMBER,$number);
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return (int)$this->getData(self::NUMBER);
    }

    /**
     * @param $additional
     * @return mixed|void
     */
    public function setAdditional($additional)
    {
        $this->setData(self::ADDITIONAL,$additional);
    }

    /**
     * @return string
     */
    public function getAdditional(): string
    {
        return (string)$this->getData(self::ADDITIONAL);
    }

    /**
     * @param $neighborhood
     * @return mixed|void
     */
    public function setNeighborhood($neighborhood)
    {
        $this->setData(self::NEIGHBORHOOD,$neighborhood);
    }

    /**
     * @return string
     */
    public function getNeighborhood(): string
    {
        return (string)$this->getData(self::NEIGHBORHOOD);
    }

    /**
     * @param $city
     * @return mixed|void
     */
    public function setCity($city)
    {
        $this->setData(self::CITY,$city);
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return (string)$this->getData(self::CITY);
    }

    /**
     * @param $cityIbgeCode
     * @return mixed|void
     */
    public function setCityIbgeCode($cityIbgeCode)
    {
        $this->setData(self::CITY_IBGE_CODE,$cityIbgeCode);
    }

    /**
     * @return int
     */
    public function getCityIbgeCode(): int
    {
        return (int)$this->getData(self::CITY_IBGE_CODE);
    }

    /**
     * @param $uf
     * @return mixed|void
     */
    public function setUf($uf)
    {
        $this->setData(self::UF,$uf);
    }

    /**
     * @return string
     */
    public function getUf(): string
    {
        return (string)$this->getData(self::UF);
    }

    /**
     * @param $country
     * @return mixed|void
     */
    public function setCountry($country)
    {
        $this->setData(self::COUNTRY,$country);
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return (string)$this->getData(self::COUNTRY);
    }

    /**
     * @param OrderAddressInterface $address
     * @return $this|mixed
     */
    public function getShippingAddressApiByAddress(OrderAddressInterface $address)
    {
        $this->setStreet(json_encode($address->getStreet()));
        $this->setNumber($address->getData(self::NUMBER));
        $this->setAdditional($address->getData(self::ADDITIONAL));
        $this->setNeighborhood($address->getRegion());
        $this->setCity($address->getCity());
        $this->setUf($address->getData(self::UF));
        $this->setCountry($address->getCountryId());
        return $this;
    }
}
