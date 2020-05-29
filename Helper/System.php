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

namespace Aislan\SalesIntegration\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class System
 */
class System extends AbstractHelper
{

    /**
     * @param $path
     * @return mixed
     */
    private function getValue($path)
    {
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isEnabled() : bool
    {
        return (bool)$this->getValue(Config::SYSTEM_SALESINTEGRATION_ENABLE);
    }

    /**
     * @return string
     */
    public function getApiUrl() : string
    {
        return (string)$this->getValue(Config::SYSTEM_SALESINTEGRATION_API_URL);
    }

    /**
     * @return string
     */
    public function getApiKey() : string
    {
        return (string)$this->getValue(Config::SYSTEM_SALESINTEGRATION_API_KEY);
    }

    /**
     * @return string
     */
    public function getErpEndpoint() : string
    {
        return (string)$this->getValue(Config::SYSTEM_SALESINTEGRATION_ERP_ENDPOINT);
    }

    /**
     * @return int
     */
    public function getApiAttempts() : int
    {
        return (int)$this->getValue(Config::SYSTEM_SALESINTEGRATION_ATTEMPTS);
    }
}
