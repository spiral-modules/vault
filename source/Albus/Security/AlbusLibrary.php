<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Security;

use Spiral\Security\Library;

/**
 * Default albus permissions and rules.
 */
class AlbusLibrary extends Library
{
    /**
     * @var array
     */
    protected $permissions = [
        'albus.dashboard'
    ];
}