<?php
/**
 * Package: vita-dashboard
 * User: viniciusdesa
 * Date: 29/06/13
 * Time: 07:58
 */

namespace Vita\AuthModule;

use Phalcon\Loader,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Mvc\View,
    Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     */
    public function registerAutoloaders()
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'Vita\AuthModule\Controllers' => __DIR__ . '/Controllers/',
                'Vita\AuthModule\Models' => __DIR__ . '/Models/',
            )
        );

        $loader->register();
    }

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices($di)
    {
        //Registering a dispatcher
        $di['dispatcher'] = function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Vita\AuthModule\Controllers");
            return $dispatcher;
        };

        //Registering the view component
        $di['view'] = function () {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/Resources/views/');
            return $view;
        };

        $di['router'] = function () {

            //Use the annotations router
            $router = new \Phalcon\Mvc\Router();
            $router->add(
                "/teste",
                array(
                    "controller" => "index",
                    "action"     => "teste",
                )
            );
            echo 'adasdasdas';
            return $router;
        };
    }

}