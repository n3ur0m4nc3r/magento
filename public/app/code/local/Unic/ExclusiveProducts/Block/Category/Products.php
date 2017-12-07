<?php

class Unic_ExclusiveProducts_Block_Category_Products
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    const MOST_EXPENSIVE_PRODUCT_LIMIT = 3;

    /**
    * Don't render the widget if category id path is not available
    *
    * @return string
    */
    protected function _toHtml()
    {
        if ($this->getCategoryIdPath()) {
            return parent::_toHtml();
        }

        return '';
    }

    /**
     * Get 3 most expensive products of pre-set category
     *
     * @return array|null
     */
    public function getExclusiveProducts()
    {
        $idPath = explode('/', $this->getCategoryIdPath());

        if (count($idPath) < 2) {
            return;
        }

        $categoryId = $idPath[1];
        $category = Mage::getModel('catalog/category')->load($categoryId);

        if (!$category->getId()) {
            return;
        }

        $categoryProductCollection = $category->getProductCollection();
        $categoryProductCollection
            ->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
            ->addAttributeToSelect('name')
            ->setOrder('price', 'DESC')
            ->setPageSize(self::MOST_EXPENSIVE_PRODUCT_LIMIT)
            ->setCurPage(1);

        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($categoryProductCollection);

        return $categoryProductCollection;
    }
}
