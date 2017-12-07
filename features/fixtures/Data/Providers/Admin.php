<?php

namespace Data\Providers;

use Magefix\Fixtures\Data\Provider;

/**
 * Class Admin
 *
 * @package Data\Providers
 */
class Admin implements Provider
{
    /**
     * @return string
     */
    public function getUsername()
    {
        return 'admin' . mt_rand(0, 1000);
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return 'admin';
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return 'admin';
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        $random = substr(md5(rand()), 0, 7);

        return 'admin' . $random . '@fixture.com';
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return '123123pass';
    }

    /**
     * @return string
     */
    public function getRoleIds()
    {
        return [1];
    }
}
