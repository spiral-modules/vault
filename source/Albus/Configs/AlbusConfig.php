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
        //Default albus controller
        'defaultController' => '',
        'controllers'       => [],
        'navigation'        => [],

        //Example: albus/users/addresses/1/remove/123
        'route'             => [
            'middlewares' => [],
            'pattern'     => 'albus[/<controller>[/<action>[/<id>[/<operation>[/<childID>]]]]]',
            'matchHost'  => false,
        ]
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
            $this->config['route']['pattern'],
            $this->config['controllers'],
            ['controller' => $this->config['defaultController']]
        );

        if ($this->config['route']['matchHost']) {
            $route->matchHost(true);
        }

        return $route->middleware($this->config['route']['middlewares']);
    }
}