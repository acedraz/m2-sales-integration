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

/**
 * Class Config
 */
class Config
{
    const AUTHORIZATION = 'Authorization';
    const BEARER = 'Bearer';
    const ACCEPT = 'Accept';
    const APPLICATION_JSON = 'application/json';
    const ERROR_API_REQUEST = 'Error in API request: ';
    const SYSTEM_SALESINTEGRATION_GENERAL = 'movies_integration/general/';
    const SYSTEM_SALESINTEGRATION_ENABLE = self::SYSTEM_SALESINTEGRATION_GENERAL.'enable';
    const SYSTEM_SALESINTEGRATION_API_URL = self::SYSTEM_SALESINTEGRATION_GENERAL.'api_url';
    const SYSTEM_SALESINTEGRATION_API_KEY = self::SYSTEM_SALESINTEGRATION_GENERAL.'api_key';
    const SYSTEM_SALESINTEGRATION_ATTEMPTS = self::SYSTEM_SALESINTEGRATION_GENERAL.'attempts';
    const SYSTEM_SALESINTEGRATION_ERP_ENDPOINT = self::SYSTEM_SALESINTEGRATION_GENERAL.'endpoint';
}
