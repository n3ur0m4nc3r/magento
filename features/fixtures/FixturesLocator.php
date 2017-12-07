<?php

use Magefix\Parser\ResourceLocator;

/**
 * Class FixturesLocator
 */
class FixturesLocator implements ResourceLocator
{
	/**
	 * @return string
	 */
    public function getLocation()
    {
        return 'features/fixtures/yaml/';
    }
}
