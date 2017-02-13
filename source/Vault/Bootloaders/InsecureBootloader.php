<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Bootloaders;

use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Security\ActorInterface;
use Spiral\Security\Actors\Guest;
use Spiral\Security\PermissionsInterface;
use Spiral\Vault\Configs\VaultConfig;
use Spiral\Vault\Security\InsecureRule;

/**
 * Development helper, DO NOT USE in production. Allows full access to Vault for Guest actor.
 */
class InsecureBootloader extends Bootloader
{
    const BOOT = true;
    const ROLE = Guest::ROLE;

    const BINDINGS = [
        ActorInterface::class => Guest::class
    ];

    /**
     * @param PermissionsInterface $permissions
     * @param VaultConfig          $config
     */
    public function boot(PermissionsInterface $permissions, VaultConfig $config)
    {
        if (!$permissions->hasRole(static::ROLE)) {
            $permissions->addRole(static::ROLE);
        }

        $namespace = $config->guardNamespace();

        //Following rule will raise log message to notify that insecure setting were used
        $permissions->associate(static::ROLE, "{$namespace}.*", InsecureRule::class);
        $permissions->associate(static::ROLE, "{$namespace}.*.*", InsecureRule::class);
        $permissions->associate(static::ROLE, "{$namespace}.*.*.*", InsecureRule::class);
        $permissions->associate(static::ROLE, "{$namespace}.*.*.*.*", InsecureRule::class);
    }
}