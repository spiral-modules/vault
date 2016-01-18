<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Bootloaders;

use Spiral\Albus\Albus;
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
        'albus'           => Albus::class,
        Navigation::class => [Albus::class, 'navigation']
    ];

    /**
     * @param HttpDispatcher $http
     * @param Albus          $albus
     */
    public function boot(HttpDispatcher $http, Albus $albus)
    {
        $http->addRoute($albus->route());
    }
}