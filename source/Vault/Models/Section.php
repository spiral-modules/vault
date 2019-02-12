<?php
declare(strict_types=1);
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Models;

use Spiral\Core\Component;
use Spiral\Translator\Traits\TranslatorTrait;
use Spiral\Vault\Vault;

class Section extends Component
{
    use TranslatorTrait;

    /**
     * @var Vault
     */
    private $vault = null;

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
     * @param Vault $vault
     * @param array $section
     */
    public function __construct(Vault $vault, array $section)
    {
        $this->vault = $vault;
        $this->section = $section;

        foreach ($this->section['items'] as $target => $item) {
            $this->items[] = new Item($vault, $target, $item);
        }
    }

    /**
     * Section title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->say($this->section['title']);
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->section['icon'];
    }

    /**
     * Must return true is section has at least one available item.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        foreach ($this->items as $item) {
            if ($item->isVisible()) {
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
     *
     * @return bool
     */
    public function hasController(string $controller): bool
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
    public function getItems(): array
    {
        return $this->items;
    }
}