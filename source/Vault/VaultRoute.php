<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Vault;

use Spiral\Http\Routing\AbstractRoute;
use Spiral\Http\Routing\Traits\CoreTrait;

class VaultRoute extends AbstractRoute
{
    use CoreTrait;

    /**
     * @var Vault
     */
    protected $vault = null;

    /**
     * @param string $name
     * @param string $pattern
     * @param array  $defaults
     */
    public function __construct($name, $pattern, array $defaults)
    {
        parent::__construct($name, $defaults);
        $this->pattern = $pattern;
    }

    /**
     * {@inheritdoc}
     */
    protected function createEndpoint()
    {
        $route = $this;

        return function () use ($route) {
            $matches = $route->getMatches();

            return $route->callAction($matches['controller'], $matches['action'], $matches);
        };
    }
}