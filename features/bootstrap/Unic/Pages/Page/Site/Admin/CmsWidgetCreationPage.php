<?php

namespace Unic\Pages\Page\Site\Admin;

use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\ElementNotFoundException;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page as PageObject;

/**
 * Class CmsWidgetCreationPage
 * @package Unic\Pages\Page\Site\Admin
 */
class CmsWidgetCreationPage extends PageObject
{
    protected $path = 'index.php/admin/widget_instance/new/key/{key}/';
    protected $elements = array(
        'Edit Form' => ['xpath' => '//*[@id="edit_form"]'],
        'Dropdown' => ['xpath' => '//*[@id="type"]']
    );

    /**
     * @param $key
     */
    public function newAction($key)
    {
        $this->open(['key' => $key]);
        $this->getElement('Edit Form');
    }

    public function clickDropdown()
    {
        $this->getElement('Dropdown');
    }

    /**
     * @return bool
     */
    public function exclusiveProductsWidgetOptionExists()
    {
        $select = $this->getElement('Dropdown');
        $options = $select->findAll('named', array('option', 'Dropdown'));
        $optionValues = array_map(create_function('$option', 'return $option->getValue();'), $options);

        return in_array('sales/widget_guest_form', $optionValues);
    }
}
