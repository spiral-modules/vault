<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Navigation;

class Section
{
    public function isAvailable()
    {
        return true;
    }

    public function getItems()
    {
        return [];
    }
}