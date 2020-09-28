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

/**
 * Interface SystemInterface
 * @api
 */
interface SystemInterface
{
    /**
     * @return bool
     */
    public function isEnabled() : bool;

    /**
     * @return string
     */
    public function getApiUrl() : string;

    /**
     * @return string
     */
    public function getApiKey() : string;

    /**
     * @return string
     */
    public function getErpEndpoint() : string;

    /**
     * @return int
     */
    public function getApiAttempts() : int;

    /**
     * @return string
     */
    public function getLogFile() : string;
}
