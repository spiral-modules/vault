<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault;

use Spiral\Security\ActorInterface;

interface UserInterface extends ActorInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}