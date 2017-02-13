<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Bootloaders;

use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Core\ContainerInterface;
use Spiral\Http\HttpDispatcher;
use Spiral\Vault\Configs\VaultConfig;
use Spiral\Vault\Vault;

/**
 * Boots vault administration panel bindings and routes. You can always extend this bootloader and
 * disable booting to register route manually.
 */
class VaultBootloader extends Bootloader
{
    const BOOT = true;

    /**
     * @var \Spiral\Vault\VaultRoute
     */
    private $route;

    /**
     * @var array
     */
    const SINGLETONS = [
        'vault' => [self::class, 'makeVault']
    ];

    /**
     * @param HttpDispatcher $http
     * @param VaultConfig    $config
     */
    public function boot(HttpDispatcher $http, VaultConfig $config)
    {
        $this->route = $config->makeRoute('vault')->withCore('vault');

        $http->addRoute($this->route);
    }

    /**
     * @param VaultConfig        $config
     * @param ContainerInterface $container
     *
     * @return Vault
     */
    protected function makeVault(VaultConfig $config, ContainerInterface $container): Vault
    {
        return new Vault($config, $this->route, $container);
    }
}