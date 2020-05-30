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

use Aislan\SalesIntegration\Api\PostOrderApiInterface;
use Magento\Framework\Webapi\Rest\Request;

/**
 * Class PostOrderApi
 */
class PostOrderApi implements PostOrderApiInterface
{

    /**
     * @var Request
     */
    private $_request;

    /**
     * PostOrderApi constructor.
     * @param \Magento\Framework\Webapi\Rest\Request $_request
     */
    public function __construct(
        Request $_request
    ) {
        $this->_request = $_request;
    }

    /**
     * @param $customer
     * @return mixed
     */
    public function getOrderApi()
    {
        $data = $this->_request->getBodyParams();
        return $data;
    }
}
