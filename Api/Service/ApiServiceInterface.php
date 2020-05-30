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

namespace Aislan\SalesIntegration\Api\Service;

/**
 * Interface ApiServiceInterface
 * @api
 */
interface ApiServiceInterface
{
    /**
     * @return mixed
     */
    public function execute();

    /**
     * @param $endpoint
     * @return mixed
     */
    public function setRequestEndpoint($endpoint);

    /**
     * @param $data
     * @return mixed
     */
    public function setData($data);
}
