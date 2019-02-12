<?php
declare(strict_types=1);
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Bootloaders;

use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Core\HMVC\CoreInterface;
use Spiral\Http\HttpDispatcher;
use Spiral\Vault\Configs\VaultConfig;
use Spiral\Vault\Vault;

/**
 * Boots vault administration panel bindings and routes. You can always extend this bootloader and
 * disable booting to register route manually.
 */
class VaultBootloader extends Bootloader implements SingletonInterface
{
    const BOOT = true;

    /**
     * @var \Spiral\Vault\VaultRoute
     */
    private $route;

    /**
     * @var array
     */
    const BINDINGS = [
        'vault' => Vault::class,
    ];

    /**
     * @var array
     */
    const SINGLETONS = [
        Vault::class => [self::class, 'makeVault']
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
     * @param VaultConfig   $config
     * @param CoreInterface $core
     *
     * @return Vault
     */
    protected function makeVault(VaultConfig $config, CoreInterface $core): Vault
    {
        return new Vault($config, $this->route, $core);
    }
}