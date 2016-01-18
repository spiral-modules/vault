<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Bootloaders;

use Spiral\Albus\AlbusCore;
use Spiral\Albus\Navigation;
use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Http\HttpDispatcher;

/**
 * Boots albus administration panel bindings and routes. You can always extend this bootloader and
 * disable booting to register route manually.
 */
class AlbusBootloader extends Bootloader
{
    /**
     * Albus require real booting.
     */
    const BOOT = true;

    /**
     * @var array
     */
    protected $bindings = [
        'albus'           => AlbusCore::class,
        Navigation::class => [AlbusCore::class, 'navigation']
    ];

    /**
     * @param HttpDispatcher $http
     * @param AlbusCore      $core
     */
    public function boot(HttpDispatcher $http, AlbusCore $core)
    {
        $http->addRoute($core->route());
    }
}