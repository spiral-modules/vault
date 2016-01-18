<?php
/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Configs;

use Spiral\Albus\AlbusRoute;
use Spiral\Core\InjectableConfig;

/**
 * Configuration for Albus administration panel.
 */
class AlbusConfig extends InjectableConfig
{
    /**
     * Configuration section.
     */
    const CONFIG = 'modules/albus';

    /**
     * @var array
     */
    protected $config = [
        'middlewares'       => [],

        //Default albus controller
        'defaultController' => '',
        'controllers'       => [],
        'navigation'        => [],

        //Example: albus/users/addresses/1/remove/123
        'route'             => 'albus[/<controller>[/<action>[/<id>[/<operation>[/<childID>]]]]]',
        'domainRoute'       => false
    ];

    /**
     * List of allowed albus controllers in a form alias => class.
     *
     * Example:
     * cms    => Vendor\CMSController::class,
     * system => Albus\SystemController::class
     *
     * @return array
     */
    public function getControllers()
    {
        return $this->config['controllers'];
    }

    /**
     * @param string $name
     * @return AlbusRoute
     */
    public function createRoute($name)
    {
        $route = new AlbusRoute(
            $name,
            $this->config['route'],
            $this->config['controllers'],
            ['controller' => $this->config['defaultController']]
        );

        return $route->middleware($this->config['middlewares']);
    }
}