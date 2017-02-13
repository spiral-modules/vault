<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault;

use Spiral\Security\ActorInterface;

/**
 * Make sure to implement this interface in your user entity in order to allow external plugins to
 * create late binded relations with your application.
 */
interface UserInterface extends ActorInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}