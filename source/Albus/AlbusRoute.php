<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus;

use Spiral\Core\ContainerInterface;
use Spiral\Http\Routing\AbstractRoute;

class AlbusRoute extends AbstractRoute
{
    /**
     * @var Albus
     */
    protected $albus = null;

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
     * @param Albus $albus
     * @return $this
     */
    public function setAlbus(Albus $albus)
    {
        $this->core = $albus;
        $this->albus = $albus;

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