<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Vault;

use Psr\Http\Message\UriInterface;
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
use Spiral\Vault\Configs\VaultConfig;
use Spiral\Vault\Exceptions\VaultException;

/**
 * Vault core aggregates
 */
class Vault extends Component implements CoreInterface, SingletonInterface
{
    use BenchmarkTrait, GuardedTrait, TranslatorTrait;

    /**
     * Declaring to IoC to treat Vault as singleton.
     */
    const SINGLETON = self::class;

    /**
     * @var HttpConfig
     */
    private $httpConfig = null;

    /**
     * @var VaultConfig
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
     * VaultCore constructor.
     *
     * @param HttpConfig         $httpConfig
     * @param VaultConfig        $config
     * @param ContainerInterface $container
     */
    public function __construct(
        HttpConfig $httpConfig,
        VaultConfig $config,
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
     * Vault navigation instance.
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
                "Undefined vault controller '{$controller}'",
                ControllerException::NOT_FOUND
            );
        }

        $permission = "{$this->config->securityNamespace()}.{$controller}";

        if (!$this->guard()->allows($permission, compact('action'))) {
            throw new ControllerException(
                "Unreachable vault controller '{$controller}'",
                ControllerException::FORBIDDEN
            );
        }

        return $this->executeController($controller, $action, $parameters);
    }

    /**
     * Perform vault specific string translation.
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
     * Get vault specific uri.
     *
     * @param string      $target Target controller and action in a form of "controller::action" or
     *                            "controller:action" or "controller".
     * @param array|mixed $parameters
     * @return UriInterface
     * @throws VaultException
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
                throw new VaultException(
                    "Unable to generate uri with empty controller action and not empty parameters."
                );
            }
        }

        if (!isset($this->config->controllers()[$controller])) {
            throw new VaultException(
                "Unable to generate uri, undefined controller '{$controller}'."
            );
        }

        return $this->route->withDefaults(compact('controller', 'action'))->uri($parameters);
    }

    /**
     * @return VaultRoute
     */
    protected function createRoute()
    {
        return $this->config->createRoute('vault')->setVault($this);
    }

    /**
     * @param string $controller
     * @param string $action
     * @param array  $parameters
     * @return mixed
     * @throws ControllerException
     */
    protected function executeController($controller, $action, array $parameters)
    {
        $benchmark = $this->benchmark('callAction', $controller . '::' . ($action ?: '~default~'));
        $scope = $this->container->replace(Vault::class, $this);

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
}
