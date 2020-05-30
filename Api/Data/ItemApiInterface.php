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

use Magento\Sales\Model\Order\Item;

/**
 * Interface ItemApiInterface
 * @api
 */
interface ItemApiInterface
{
    /**
     * @param $sku
     * @return mixed
     */
    public function setSku($sku);

    /**
     * @return string
     */
    public function getSku() : string;

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param $price
     * @return mixed
     */
    public function setPrice($price);

    /**
     * @return mixed
     */
    public function getPrice();

    /**
     * @param $qty
     * @return mixed
     */
    public function setQty($qty);

    /**
     * @return mixed
     */
    public function getQty();

    /**
     * @param Item $item
     * @return mixed
     */
    public function getItemApiByItem(Item $item);
}
