<?php
/**
 * Package: vita-dashboard
 * User: viniciusdesa
 * Date: 29/06/13
 * Time: 13:23
 */

use Phalcon\DiInterface;

class AppBootstrap extends \Phalcon\Mvc\Application {

    private $env;

    public function __construct(DiInterface $di, $env = 'dev')
    {
        parent::__construct($di);
        $this->setEnv($env);
        $this->_registerServices();
    }

    /**
     * @param string $env
     * @return AppBootstrap
     */
    public function setEnv($env)
    {
        $this->env = $env;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnv()
    {
        return $this->env;
    }

    public function main()
    {
        $this->registerModules([
                'auth' => [
                    'className' => 'Vita\AuthModule\Module',
                    'path'      => __DIR__ . '/../src/Vita/AuthModule/Module.php',
                ]
            ]);
    }

    protected function _registerServices()
    {
        /**
         * Registering a router
         */
        $this->getDI()['router'] = function () {
            $router = new \Phalcon\Mvc\Router();
            $router->setDefaultModule("auth");
            return $router;
        };

        /**
         * The URL component is used to generate all kind of urls in the application
         */
        $this->getDI()['url'] = function() {
                $url = new \Phalcon\Mvc\Url();
                $url->setBaseUri('/');
                return $url;
            };

        /**
         * Start the session the first time some component request the session service
         */
        $this->getDI()['session'] = function() {
                $session = new \Phalcon\Session\Adapter\Files();
                $session->start();
                return $session;
            };
    }
}