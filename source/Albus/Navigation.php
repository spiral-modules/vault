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
     * Guard is needed to show only allowed navigation sections and items.
     *
     * @var GuardInterface
     */
    private $guard = null;

    /**
     * Navigation sections list.
     *
     * @var array
     */
    private $sections = [];

    /**
     * Navigation constructor.
     *
     * @param GuardInterface $guard
     * @param array          $section
     */
    public function __construct(GuardInterface $guard, array $section)
    {
        $this->guard = $guard;
        $this->sections = $section;
    }

    /**
     * Get all navigation sections. This is generator.
     *
     * @generator
     * @return Section[]
     */
    public function getSections()
    {
        foreach ($this->sections as $section) {
            yield new Section($this->guard, $section);
        }
    }
}