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

use Aislan\SalesIntegration\Api\Data\ItemApiInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Sales\Model\Order\Item;

/**
 * Class ItemApi
 */
class ItemApi extends AbstractModel implements ItemApiInterface
{

    const SKU = 'sku';
    const NAME = 'name';
    const PRICE = 'price';
    const QTY = 'qty';

    /**
     * @param $sku
     * @return mixed|void
     */
    public function setSku($sku)
    {
        $this->setData(self::SKU,$sku);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return (string)$this->getData(self::SKU);
    }

    /**
     * @param $name
     * @return mixed|void
     */
    public function setName($name)
    {
        $this->setData(self::NAME,$name);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->getData(self::NAME);
    }

    /**
     * @param $price
     * @return mixed|void
     */
    public function setPrice($price)
    {
        $this->setData(self::PRICE,$price);
    }

    /**
     * @return array|mixed|null
     */
    public function getPrice()
    {
        return $this->getData(self::PRICE);
    }

    /**
     * @param $qty
     * @return mixed|void
     */
    public function setQty($qty)
    {
        $this->setData(self::QTY,$qty);
    }

    /**
     * @return array|mixed|null
     */
    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    /**
     * @param Item $item
     * @return $this|mixed
     */
    public function getItemApiByItem(Item $item)
    {
        $this->setSku($item->getSku());
        $this->setName($item->getName());
        $this->setPrice($item->getPrice());
        $this->setQty($item->getQtyOrdered());
        return $this;
    }
}
