<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

if (!function_exists('vault')) {
    /**
     * @return \Spiral\Vault\Vault
     */
    function vault(): \Spiral\Vault\Vault
    {
        return spiral(\Spiral\Vault\Vault::class);
    }
}