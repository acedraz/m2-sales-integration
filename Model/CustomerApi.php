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
use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Customer\Model\Data\Customer;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * Class CustomerApi
 */
class CustomerApi extends AbstractModel implements CustomerApiInterface
{
    const NAME = 'name';
    const CPF_CNPJ = 'cpf_cnpj';
    const TELEPHONE = 'telephone';
    const CNPJ = 'cnpj';
    const RAZAO_SOCIAL = 'razao_social';
    const NOME_FANTASIA = 'nome_fantasia';
    const IE = 'ie';
    const DOB = 'dob';

    /**
     * @var TimezoneInterface
     */
    private $timezone;
    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * CustomerApi constructor.
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     * @param TimezoneInterface $timezone
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [],
        TimezoneInterface $timezone,
        AddressRepositoryInterface $addressRepository
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->timezone = $timezone;
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->setData(self::NAME,$name);
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return (string)$this->getData(self::NAME);
    }

    /**
     * @param $cpfCnpj
     */
    public function setCpfCnpj($cpfCnpj)
    {
        $this->setData(self::CPF_CNPJ,$cpfCnpj);
    }

    /**
     * @return string
     */
    public function getCpfCnpj() : string
    {
        return (string)$this->getData(self::CPF_CNPJ);
    }

    /**
     * @param $telephone
     */
    public function setTelephone($telephone)
    {
        $this->setData(self::TELEPHONE,$telephone);
    }

    /**
     * @return string
     */
    public function getTelephone() : string
    {
        return (string)$this->getData(self::TELEPHONE);
    }

    /**
     * @param $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->setData(self::CNPJ,$cnpj);
    }

    /**
     * @return string
     */
    public function getCnpj() : string
    {
        return (string)$this->getData(self::CNPJ);
    }

    /**
     * @param $razaoSocial
     */
    public function setRazaoSocial($razaoSocial)
    {
        $this->setData(self::RAZAO_SOCIAL,$razaoSocial);
    }

    /**
     * @return string
     */
    public function getRazaoSocial() : string
    {
        return (string)$this->getData(self::RAZAO_SOCIAL);
    }

    /**
     * @param $ie
     */
    public function setIe($ie)
    {
        $this->setData(self::IE,$ie);
    }

    /**
     * @return string
     */
    public function getIe() : string
    {
        return (string)$this->getData(self::IE);

    }

    /**
     * @param $dob
     */
    public function setDob($dob)
    {
        $this->setData(self::DOB,$dob);
    }

    /**
     * @return string
     */
    public function getDob() : string
    {
        return (string)$this->getData(self::DOB);
    }

    /**
     * @param $nomeFantasia
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->setData(self::NOME_FANTASIA,$nomeFantasia);
    }

    /**
     * @return string
     */
    public function getNomeFantasia()
    {
        return (string)$this->getData(self::NOME_FANTASIA);
    }

    /**
     * @param Customer $customer
     * @return $this|mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerApiByCustomer(Customer $customer)
    {
        $this->setName($customer->getFirstname() . ' ' . $customer->getMiddlename() . ' ' . $customer->getLastname());
        $this->setCpfCnpj(method_exists($customer->getExtensionAttributes(),'getCpfCnpj') ? $customer->getExtensionAttributes()->getCpfCnpj() : '000.000.000-00');
        $this->setTelephone($this->addressRepository->getById($customer->getDefaultBilling())->getTelephone());
        $this->setCnpj(method_exists($customer->getExtensionAttributes(),'getCnpj') ? $customer->getExtensionAttributes()->getCnpj() : '00.000.000/0000-00');
        $this->setRazaoSocial(method_exists($customer->getExtensionAttributes(),'getRazaoSocial') ? $customer->getExtensionAttributes()->getRazaoSocial() : '');
        $this->setNomeFantasia(method_exists($customer->getExtensionAttributes(),'getNomeFantasia') ? $customer->getExtensionAttributes()->getNomeFantasia() : '');
        $this->setIe(method_exists($customer->getExtensionAttributes(),'getIe') ? $customer->getExtensionAttributes()->getIe() : '00000000');
        $this->setDob(is_null($customer->getDob()) ? '00/00/0000' : $this->timezone->date(new \DateTime($customer->getDob()))->format('d/m/Y'));
        return $this;
    }
}
