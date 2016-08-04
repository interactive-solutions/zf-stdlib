<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 2014-09-10
 * Time: 17:27
 */

namespace InteractiveSolutions\Stdlib;

use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature;

class Module implements Feature\AutoloaderProviderInterface, Feature\ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            StandardAutoloader::class => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__ . '/src/InteractiveSolutions/Stdlib',
                ],
            ],
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
