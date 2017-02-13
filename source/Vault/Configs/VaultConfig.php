<?php
/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Configs;

use Spiral\Core\InjectableConfig;
use Spiral\Vault\VaultRoute;

/**
 * Configuration for Vault administration panel.
 */
class VaultConfig extends InjectableConfig
{
    /**
     * Configuration section.
     */
    const CONFIG = 'modules/vault';

    /**
     * @var array
     */
    protected $config = [
        'guard'       => [
            'namespace' => 'vault'
        ],

        //Allowed vault controllers
        'controllers' => [],

        //Example: vault/users/addresses/1/remove/123
        'route'       => [
            'name'        => 'vault',
            'pattern'     => 'vault[/<controller>[/<action>[/<id>[/<operation>[/<childID>]]]]]',
            'defaults'    => [],
            'middlewares' => [],
            'matchHost'   => false,
        ],

        //Navigation widget configuration
        'navigation'  => [],
    ];

    /**
     * Guard namespace (prefix for all permissions) associated with given Vault instance.
     *
     * @return string
     */
    public function guardNamespace(): string
    {
        return $this->config['guard']['namespace'];
    }

    /**
     * @param string $controller
     *
     * @return bool
     */
    public function hasController(string $controller): bool
    {
        return isset($this->config['controllers'][$controller]);
    }

    /**
     * Controller class.
     *
     * @param string $controller
     *
     * @return string
     */
    public function controllerClass(string $controller): string
    {
        return $this->config['controllers'][$controller];
    }

//    /**
//     * Vault navigation structure including sections, permissions, titles and etc.
//     *
//     * @return array
//     */
//    public function navigationSections()
//    {
//        return $this->config['navigation'];
//    }

    /**
     * @param string $name
     *
     * @return VaultRoute
     */
    public function makeRoute(string $name): VaultRoute
    {
        $route = new VaultRoute(
            $name,
            $this->config['route']['pattern'],
            $this->config['route']['defaults']
        );

        return $route->withHost(
            $this->config['route']['matchHost']
        )->withMiddleware(
            $this->config['route']['middlewares']
        );
    }
}