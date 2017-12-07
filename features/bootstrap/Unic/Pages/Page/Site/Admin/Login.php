<?php

namespace Unic\Pages\Page\Site\Admin;

use SensioLabs\Behat\PageObjectExtension\PageObject\Exception\ElementNotFoundException;
use SensioLabs\Behat\PageObjectExtension\PageObject\Page as PageObject;
use Magefix\Plugin\AdminPanelSession;

/**
 * Class Login
 *
 * @package Unic\Pages\Page\Site
 */
class Login extends PageObject
{
    use AdminPanelSession;

    protected $path = 'index.php/admin/';

    protected $elements = array(
        'Username' => ['xpath' => '//*[@id="username"]'],
        'Password' => ['xpath' => '//*[@id="login"]'],
        'Login Button' => ['css' => '#loginForm input.form-button[title="Login"]'],
        'Dashboard Popup Close' => ['xpath' => '//*[@id="message-popup-window"]/div[1]/a']
    );

    public function login($username, $password)
    {
        $this->open();
        $this->getElement('Username')->setValue($username);
        $this->getElement('Password')->setValue($password);
        $this->getElement('Login Button')->press();
        $this->getElement('Dashboard Popup Close')->click();
    }

    /**
     * @return mixed
     */
    public function getCurrentUrl()
    {
        return $this->getDriverCurrentUrl();
    }
}
