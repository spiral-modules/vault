<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Vault\Bootloaders;

use Spiral\Vault\Vault;
use Spiral\Vault\Navigation;
use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Http\HttpDispatcher;

/**
 * Boots vault administration panel bindings and routes. You can always extend this bootloader and
 * disable booting to register route manually.
 */
class VaultBootloader extends Bootloader
{
    /**
     * Vault require real booting.
     */
    const BOOT = true;

    /**
     * @var array
     */
    protected $bindings = [
        'vault'           => Vault::class,
        Navigation::class => [Vault::class, 'navigation']
    ];

    /**
     * @param HttpDispatcher $http
     * @param Vault          $vault
     */
    public function boot(HttpDispatcher $http, Vault $vault)
    {
        $http->addRoute($vault->route());
    }
}