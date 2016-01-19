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
     * Default permissions namespace.
     */
    const GUARD_NAMESPACE = 'albus';

    /**
     * @var array
     */
    protected $config = [
        'guardNamespace' => 'albus',

        //Default albus controller
        'controllers'    => [],
        'navigation'     => [],

        //Example: albus/users/addresses/1/remove/123
        'route'          => [
            'middlewares' => [],
            'pattern'     => 'albus[/<controller>[/<action>[/<id>[/<operation>[/<childID>]]]]]',
            'defaults'    => [],
            'matchHost'   => false,
        ]
    ];

    public function securityNamespace()
    {
        if (empty($this->config['guardNamespace'])) {
            return self::GUARD_NAMESPACE;
        }

        return $this->config['guardNamespace'];
    }

    /**
     * List of allowed albus controllers in a form alias => class.
     *
     * Example:
     * cms    => Vendor\CMSController::class,
     * system => Albus\SystemController::class
     *
     * @return array
     */
    public function controllers()
    {
        return $this->config['controllers'];
    }

    /**
     * Albus navigation structure including sections, permissions, titles and etc.
     *
     * @return array
     */
    public function navigationSections()
    {
        return $this->config['navigation'];
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
            $this->config['route']['defaults']
        );

        if ($this->config['route']['matchHost']) {
            $route->matchHost(true);
        }

        return $route->middleware($this->config['route']['middlewares']);
    }
}