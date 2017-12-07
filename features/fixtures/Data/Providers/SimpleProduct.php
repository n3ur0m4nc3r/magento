<?php

namespace Data\Providers;

use Mage_Catalog_Model_Product_Type;
use Mage_Catalog_Model_Product_Visibility;
use Mage;
use Magefix\Fixtures\Data\Provider;

/**
 * Class SimpleProduct
 *
 * @package Data\Providers
 */
class SimpleProduct implements Provider
{
    /**
     * @return int
     */
    public function getDefaultAttributeSetId()
    {
        $entityTypeId = Mage::getModel('eav/entity')->setType('catalog_product')->getTypeId();
        return Mage::getModel('eav/entity_type')->load($entityTypeId)->getDefaultAttributeSetId();
    }

    /**
     * @return array
     */
    public function getCategoryIds()
    {
        $categoryFixture = new Category();
        $category = Mage::getResourceModel('catalog/category_collection')
            ->addFieldToFilter('name', $categoryFixture->getName())
            ->getFirstItem();

        return $category->getEntityId();
    }

    /**
     * @return string
     */
    public function getSku()
    {
        $random = substr(md5(rand()), 0, 7);

        return 'SKU-' . $random;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return round(mt_rand(0, 100), 4);
    }

    /**
     * @return int
     */
    public function getTypeId()
    {
        return Mage_Catalog_Model_Product_Type::TYPE_SIMPLE;
    }

    /**
     * @return int
     */
    public function getStockQty()
    {
        return 10;
    }

    /**
     * @return int
     */
    public function getVisibility()
    {
        return Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH;
    }
}
