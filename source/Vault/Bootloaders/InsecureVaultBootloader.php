<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Vault\Bootloaders;

use Spiral\Vault\Configs\VaultConfig;
use Spiral\Vault\Security\Rules\InsecureRule;
use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Security\Entities\Actors\Guest;
use Spiral\Security\PermissionsInterface;

/**
 * Development helper, DO NOT USE in production. Allows full access to Vault for any guest (no
 * authorization is required).
 */
class InsecureVaultBootloader extends Bootloader
{
    const BOOT = true;
    const ROLE = Guest::ROLE;

    /**
     * @param PermissionsInterface $permissions
     * @param VaultConfig          $config
     */
    public function boot(PermissionsInterface $permissions, VaultConfig $config)
    {
        if (!$permissions->hasRole(static::ROLE)) {
            $permissions->addRole(static::ROLE);
        }

        $namespace = $config->securityNamespace();

        //Following rule will raise log message to notify that insecure setting were used
        $permissions->associate(static::ROLE, "{$namespace}.*", InsecureRule::class);
        $permissions->associate(static::ROLE, "{$namespace}.*.*", InsecureRule::class);
        $permissions->associate(static::ROLE, "{$namespace}.*.*.*", InsecureRule::class);
        $permissions->associate(static::ROLE, "{$namespace}.*.*.*.*", InsecureRule::class);
    }
}