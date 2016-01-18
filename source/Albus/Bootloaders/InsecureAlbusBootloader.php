<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Bootloaders;

use Spiral\Albus\Security\Rules\InsecureRule;
use Spiral\Core\Bootloaders\Bootloader;
use Spiral\Security\Entities\Actors\Guest;
use Spiral\Security\PermissionsInterface;

/**
 * Development helper, DO NOT USE in production. Allows full access to Albus for any guest (no
 * authorization is required).
 */
class InsecureAlbusBootloader extends Bootloader
{
    const BOOT = true;
    const ROLE = Guest::ROLE;

    /**
     * @param PermissionsInterface $permissions
     */
    public function boot(PermissionsInterface $permissions)
    {
        if (!$permissions->hasRole(static::ROLE)) {
            $permissions->addRole(static::ROLE);
        }

        //Following rule will raise log message to notify that insecure setting were used
        $permissions->associate(static::ROLE, 'albus.*', InsecureRule::class);

        //Controller specific permissions
        $permissions->associate(static::ROLE, 'albus.*.*', InsecureRule::class);
    }
}