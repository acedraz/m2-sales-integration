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

use Magento\Customer\Model\Data\Customer;

/**
 * Interface CustomerApiInterface
 * @api
 */
interface CustomerApiInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $cpfCnpj
     * @return mixed
     */
    public function setCpfCnpj($cpfCnpj);

    /**
     * @return mixed
     */
    public function getCpfCnpj();

    /**
     * @param $telephone
     * @return mixed
     */
    public function setTelephone($telephone);

    /**
     * @return mixed
     */
    public function getTelephone();

    /**
     * @param $cnpj
     * @return mixed
     */
    public function setCnpj($cnpj);

    /**
     * @return mixed
     */
    public function getCnpj();

    /**
     * @param $razaoSocial
     * @return mixed
     */
    public function setRazaoSocial($razaoSocial);

    /**
     * @return mixed
     */
    public function getRazaoSocial();

    /**
     * @param $ie
     * @return mixed
     */
    public function setIe($ie);

    /**
     * @return mixed
     */
    public function getIe();

    /**
     * @param $dob
     * @return mixed
     */
    public function setDob($dob);

    /**
     * @return mixed
     */
    public function getDob();

    /**
     * @param $nomeFantasia
     * @return mixed
     */
    public function setNomeFantasia($nomeFantasia);

    /**
     * @return mixed
     */
    public function getNomeFantasia();

    /**
     * @param Customer $customer
     * @return mixed
     */
    public function getCustomerApiByCustomer(Customer $customer);
}
