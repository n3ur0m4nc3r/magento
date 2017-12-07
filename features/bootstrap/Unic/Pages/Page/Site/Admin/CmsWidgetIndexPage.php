<?php

namespace Unic\Pages\Page\Site\Admin;

use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\ElementNotFoundException;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page as PageObject;
use Magefix\Plugin\AdminPanelSession;

/**
 * Class CmsWidgetIndexPage
 * @package Unic\Pages\Page\Site\Admin
 */
class CmsWidgetIndexPage extends PageObject
{
    use AdminPanelSession;

    protected $path = 'index.php/admin/widget_instance/index/key/{key}/';

    /**
     * @param $key
     */
    public function indexAction($key)
    {
        $this->open(['key' => $key]);
    }

    /**
     * @return mixed
     */
    public function getCurrentUrl()
    {
        return $this->getDriverCurrentUrl();
    }
}
