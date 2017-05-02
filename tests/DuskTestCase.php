<?php

namespace Tests;

use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use App\Traits\InitDatabaseTrait;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;
    use InitDatabaseTrait;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        //  static::startChromeDriver();
    }

    /**
     * Extend functionality of default trait using custom from InitialiseDatabaseTrait
     */
    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        //Can be used Phantom.js
        return RemoteWebDriver::create(
            env('APP_URL'), DesiredCapabilities::chrome()
        );
    }
}
