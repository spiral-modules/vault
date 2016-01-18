<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Bootloaders;

use Spiral\Albus\AlbusCore;
use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Http\HttpDispatcher;

/**
 * Boots albus administration panel bindings and routes.
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
        'albus' => AlbusCore::class
    ];

    /**
     * @var array
     */
    protected $singletons = [

    ];

    /**
     * @param HttpDispatcher $http
     */
    public function boot(HttpDispatcher $http)
    {

    }
}