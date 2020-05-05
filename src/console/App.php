<?php
// +------------------------------------------------------------------------------------
// | Desc: Console App
// + -----------------------------------------------------------------------------------
// | By: PhpStorm 
// +------------------------------------------------------------------------------------
// | Date: 2020/5/5 
// + -----------------------------------------------------------------------------------
// | Author: cleverstone
// +------------------------------------------------------------------------------------

namespace clever\console;


class App
{
    // clever php version 1.0.0
    const CLEVERPHP_VERSION = '1.0.0';

    // application instance
    public static $app;

    /**
     * App constructor.
     */
    public function __construct()
    {
        self::$app = $this;

        // bootstrap
        $this->bootstrap();
    }

    protected function bootstrap()
    {
        // register error and exception handler
        $this->registerErrorAndExceptionHandler();
        // register application configuration
        $this->registerConfigure();
        // register application debug record handler
        $this->registerDebug();
    }

    protected function registerErrorAndExceptionHandler()
    {

    }

    protected function registerConfigure()
    {

    }

    protected function registerDebug()
    {

    }

    /**
     * Application gateway
     *
     * @author cleverstone
     */
    public function run()
    {

    }
}