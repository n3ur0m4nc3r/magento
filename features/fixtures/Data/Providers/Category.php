<?php

namespace Data\Providers;

use Mage;
use Magefix\Fixtures\Data\Provider;

/**
 * Class Category
 *
 * @package Data\Providers
 */
class Category implements Provider
{
    /**
     * @return int
     */
    public function getParentId()
    {
        return Mage::app()->getStore('default')->getRootCategoryId();
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return Mage::app()->getStore('default')->getId();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Sample Category';
    }
}
