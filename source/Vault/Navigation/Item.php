<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Vault\Navigation;

use Spiral\Security\GuardInterface;

/**
 * @todo get badge class (dynamic value)
 */
class Item
{
    /**
     * @var string
     */
    private $target = '';

    /**
     * @var array
     */
    private $item = [
        'title'    => '',
        'badge'    => '',
        'requires' => '',
    ];

    /**
     * @param string $target
     * @param array  $options
     */
    public function __construct($target, array $options)
    {
        $this->target = $target;
        $this->item = $options;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->item['title'];
    }

    /**
     * Check if item is allowed to be displayed.
     *
     * @param GuardInterface $guard
     * @return bool
     */
    public function isAllowed(GuardInterface $guard)
    {
        if (!isset($this->item['requires'])) {
            //No display protection
            return true;
        }

        return $guard->allows($this->item['requires']);
    }
}