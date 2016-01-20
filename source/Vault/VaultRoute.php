<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Vault;

use Spiral\Core\ContainerInterface;
use Spiral\Http\Routing\AbstractRoute;

class VaultRoute extends AbstractRoute
{
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
        $this->name = $name;
        $this->pattern = $pattern;

        $this->defaults = $defaults;
    }

    /**
     * @param Vault $vault
     * @return $this
     */
    public function setVault(Vault $vault)
    {
        $this->core = $vault;
        $this->vault = $vault;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function createEndpoint(ContainerInterface $container)
    {
        $route = $this;

        return function () use ($container, $route) {
            return $route->callAction(
                $container,
                $route->matches['controller'],
                $route->matches['action'],
                $route->matches
            );
        };
    }
}