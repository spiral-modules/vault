<?php
/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Configs;

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
        //Example: albus/users/addresses/1/remove/123
        'route'             => 'albus[/<controller>[/<action>[/<id>[/<operation>[/<childID>]]]]]',
        //Default albus controller
        'defaultController' => '',
        'controllers'       => [],
        'navigation'        => []
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
}