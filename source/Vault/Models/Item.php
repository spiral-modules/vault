<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Models;

use Psr\Http\Message\UriInterface;
use Spiral\Core\Component;
use Spiral\Translator\Traits\TranslatorTrait;
use Spiral\Vault\Vault;

class Item extends Component
{
    use TranslatorTrait;

    /**
     * @var Vault
     */
    private $vault;

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
    public function __construct(Vault $vault, string $target, array $options)
    {
        $this->vault = $vault;
        $this->target = $target;
        $this->item = $options;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->say($this->item['title']);
    }

    /**
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return $this->vault->uri($this->getTarget());
    }

    /**
     * Check if item is visible.
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        //Remove :action
        $target = current(explode(':', $this->getTarget()));

        return $this->vault->getGuard()->allows(
            "{$this->vault->getConfig()->guardNamespace()}.{$target}"
        );
    }
}