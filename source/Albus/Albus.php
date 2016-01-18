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
use Spiral\Translator\Traits\TranslatorTrait;

/**
 * Albus core aggregates
 */
class Albus extends Component implements CoreInterface, SingletonInterface
{
    use BenchmarkTrait, GuardedTrait, TranslatorTrait;

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
     * Currently active controller (needed to highlight navigation).
     *
     * @var string
     */
    private $controller = '';

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
        return new Navigation($this->guard(), $this->config->navigationSections());
    }

    /**
     * Currently active controller id.
     *
     * @return string
     */
    public function activeController()
    {
        return $this->controller;
    }

    /**
     * {@inheritdoc}
     */
    public function callAction($controller, $action = '', array $parameters = [])
    {
        if (!isset($this->config->controllers()[$controller])) {
            throw new ControllerException(
                "Undefined albus controller '{$controller}'",
                ControllerException::NOT_FOUND
            );
        }

        if (!$this->guard()->allows("albus.{$controller}", compact('action'))) {
            throw new ControllerException(
                "Unreachable albus controller '{$controller}'",
                ControllerException::FORBIDDEN
            );
        }

        $benchmark = $this->benchmark('callAction', $controller . '::' . ($action ?: '~default~'));
        $scope = $this->container->replace(CoreInterface::class, $this);

        //To let navigation know current controller
        $this->controller = $controller;

        try {
            //Initiating controller with all required dependencies
            $object = $this->container->make(
                $this->config->controllers()[$controller]
            );

            if (!$object instanceof ControllerInterface) {
                throw new ControllerException(
                    "Invalid '{$controller}', ControllerInterface not implemented.",
                    ControllerException::NOT_FOUND
                );
            }

            return $object->callAction($action, $parameters);
        } finally {
            $this->benchmark($benchmark);
            $this->container->restore($scope);

            $this->controller = '';
        }
    }

    /**
     * Perform albus specific string translation.
     *
     * @param string $string
     * @param array  $options
     * @return string
     */
    public function translate($string, array $options = [])
    {
        return $this->say($string, $options);
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

        if (!isset($this->config->controllers()[$controller])) {
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
