<?php
declare(strict_types=1);
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Models;

use Psr\Http\Message\ServerRequestInterface;
use Spiral\Core\Component;
use Spiral\Vault\Vault;

class Navigation extends Component
{
    /**
     * Associated vault instance.
     *
     * @var Vault
     */
    private $vault;

    /**
     * Currently active request (for uri resolution).
     *
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @param \Spiral\Vault\Vault                      $vault
     * @param \Psr\Http\Message\ServerRequestInterface $request
     */
    public function __construct(Vault $vault, ServerRequestInterface $request)
    {
        $this->vault = $vault;
        $this->request = $request;
    }

    /**
     * Currently active controller.
     *
     * @return string
     */
    public function getController(): string
    {
        return $this->request->getAttribute('route')->getMatches()['controller'];
    }

    /**
     * Get all navigation sections. This is generator.
     *
     * @generator
     * @return \Generator|Section[]
     */
    public function getSections(): \Generator
    {
        foreach ($this->vault->getConfig()->navigationSections() as $section) {
            yield new Section($this->vault, $section);
        }
    }
}