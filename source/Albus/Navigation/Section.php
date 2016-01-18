<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Navigation;

use Spiral\Security\GuardInterface;

/**
 * @todo get badge class (dynamic value)
 */
class Section
{
    /**
     * @var GuardInterface
     */
    private $guard = null;

    /**
     * @var array
     */
    private $section = [
        'title' => '',
        'badge' => '',
        'icon'  => '',
        'items' => []
    ];

    /**
     * @var Item[]
     */
    private $items = [];

    /**
     * @param GuardInterface $guard
     * @param array          $section
     */
    public function __construct(GuardInterface $guard, array $section)
    {
        $this->guard = $guard;
        $this->section = $section;

        foreach ($this->section['items'] as $target => $item) {
            $this->items[] = new Item($target, $item);
        }
    }

    /**
     * Section title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->section['title'];
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->section['icon'];
    }

    /**
     * Must return true is section has at least one available item.
     *
     * @return bool
     */
    public function isAvailable()
    {
        foreach ($this->items as $item) {
            if ($item->isAllowed($this->guard)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Must return true if at least one of section items points to a given controller (based on
     * target).
     *
     * @param string $controller
     * @return bool
     */
    public function hasController($controller)
    {
        foreach ($this->items as $item) {
            if (
                $item->getTarget() == $controller
                || strpos($item->getTarget(), $controller . ':') === 0
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }
}