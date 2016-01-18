<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus;

use Spiral\Core\ContainerInterface;
use Spiral\Http\Exceptions\ClientExceptions\ForbiddenException;
use Spiral\Http\Routing\AbstractRoute;

class AlbusRoute extends AbstractRoute
{
    /**
     * Direct controller mapping.
     *
     * @var array
     */
    private $controllers = [];

    /**
     * @var AlbusCore
     */
    protected $albus = null;

    /**
     * @param string $name
     * @param string $pattern
     * @param array  $controllers
     * @param array  $defaults
     */
    public function __construct($name, $pattern, array $controllers, array $defaults)
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->controllers = $controllers;

        $this->defaults = $defaults;
    }

    /**
     * @param AlbusCore $albus
     * @return $this
     */
    public function setAlbus(AlbusCore $albus)
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
            $controller = $route->matches['controller'];

            //Due we are expecting part of class name we can remove some garbage (see to-do below)
            $controller = strtolower(preg_replace('/[^a-z_0-9]+/i', '', $controller));

            if (isset($route->controllers[$controller])) {
                //Aliased
                $controller = $route->controllers[$controller];
            } else {
                //Unable to find requested controller
                //todo: notify albus core
                throw new ForbiddenException();
            }

            return $route->callAction(
                $container,
                $controller,
                $route->matches['action'],
                $route->matches
            );
        };
    }
}