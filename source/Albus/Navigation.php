<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus;

use Spiral\Albus\Navigation\Section;
use Spiral\Security\GuardInterface;

class Navigation
{
    /**
     * @var array
     */
    private $navigation = [];

    /**
     * @param GuardInterface $guard
     * @param array          $navigation
     */
    public function __construct(GuardInterface $guard, array $navigation)
    {

    }

    /**
     * Get all navigation sections.
     *
     * @return Section[]
     */
    public function getSections()
    {
        return [];
    }
}