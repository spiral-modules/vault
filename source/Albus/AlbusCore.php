<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus;

use Psr\Http\Message\UriInterface;
use Spiral\Albus\Configs\AlbusConfig;
use Spiral\Albus\Exceptions\AlbusException;
use Spiral\Core\Component;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Core\ContainerInterface;
use Spiral\Core\Exceptions\ControllerException;
use Spiral\Core\HMVC\ControllerInterface;
use Spiral\Core\HMVC\CoreInterface;
use Spiral\Debug\Traits\BenchmarkTrait;
use Spiral\Http\Configs\HttpConfig;
use Spiral\Http\Routing\RouteInterface;
use Spiral\Security\Traits\GuardedTrait;

/**
 * Albus core aggregates
 */
class AlbusCore extends Component implements CoreInterface, SingletonInterface
{
    use BenchmarkTrait, GuardedTrait;

    /**
     * Declaring to IoC to treat Albus as sinleton.
     */
    const SINGLETON = self::class;

    /**
     * @var HttpConfig
     */
    private $httpConfig = null;

    /**
     * @var AlbusConfig
     */
    private $config = null;

    /**
     * @var RouteInterface
     */
    private $route = null;

    /**
     * @var ContainerInterface
     */
    protected $container = null;

    /**
     * AlbusCore constructor.
     *
     * @param HttpConfig         $httpConfig
     * @param AlbusConfig        $config
     * @param ContainerInterface $container
     */
    public function __construct(
        HttpConfig $httpConfig,
        AlbusConfig $config,
        ContainerInterface $container
    ) {
        $this->httpConfig = $httpConfig;
        $this->config = $config;
        $this->container = $container;

        $this->route = $this->createRoute();
    }

    /**
     * @return RouteInterface
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * Albus navigation instance.
     */
    public function navigation()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function callAction($controller, $action = '', array $parameters = [])
    {
        if (!$this->guard()->allows('albus', compact('controller', 'action'))) {
            throw new ControllerException(
                "Unreachable albus controller '{$controller}'",
                ControllerException::FORBIDDEN
            );
        }

        if (!in_array($controller, $this->config->getControllers())) {
            throw new ControllerException(
                "Undefined albus controller '{$controller}'",
                ControllerException::NOT_FOUND
            );
        }

        $benchmark = $this->benchmark('callAction', $controller . '::' . ($action ?: '~default~'));
        $scope = $this->container->replace(CoreInterface::class, $this);

        try {
            //Initiating controller with all required dependencies
            $controller = $this->container->make($controller);

            if (!$controller instanceof ControllerInterface) {
                throw new ControllerException(
                    "No such controller '{$controller}' found.",
                    ControllerException::NOT_FOUND
                );
            }

            return $controller->callAction($action, $parameters);
        } finally {
            $this->benchmark($benchmark);
            $this->container->restore($scope);
        }
    }

    /**
     * Get albus specific uri.
     *
     * @param string      $target Target controller and action in a form of "controller::action" or
     *                            "controller:action" or "controller".
     * @param array|mixed $parameters
     * @return UriInterface
     * @throws AlbusException
     */
    public function uri($target, $parameters = [])
    {
        $target = str_replace('::', ':', $target);

        $controller = $action = '';
        if (strpos($target, ':') !== false) {
            list($controller, $action) = explode(':', $target);
        } else {
            $controller = $target;

            if (!empty($parameters)) {
                throw new AlbusException(
                    "Unable to generate uri with empty controller action and not empty parameters."
                );
            }
        }

        if (!isset($this->config->getControllers()[$controller])) {
            throw new AlbusException(
                "Unable to generate uri, undefined controller '{$controller}'."
            );
        }

        $parameters['controller'] = $controller;
        $parameters['action'] = $action;

        return $this->route->uri($parameters, $this->httpConfig->basePath());
    }

    /**
     * @return AlbusRoute
     */
    protected function createRoute()
    {
        return $this->config->createRoute('albus')->setAlbus($this);
    }
}
