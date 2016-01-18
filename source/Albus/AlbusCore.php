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
use Spiral\Core\Component;
use Spiral\Core\ContainerInterface;
use Spiral\Core\Exceptions\ControllerException;
use Spiral\Core\HMVC\ControllerInterface;
use Spiral\Core\HMVC\CoreInterface;
use Spiral\Debug\Traits\BenchmarkTrait;
use Spiral\Http\Uri;
use Spiral\Security\Traits\GuardedTrait;

/**
 * Albus core aggregates
 */
class AlbusCore extends Component implements CoreInterface
{
    use BenchmarkTrait, GuardedTrait;

    /**
     * @var AlbusConfig
     */
    private $config = null;


    /**
     * @var ContainerInterface
     */
    protected $container = null;

    /**
     * @param AlbusConfig        $config
     * @param ContainerInterface $container
     */
    public function __construct(
        AlbusConfig $config,
        ContainerInterface $container
    ) {
        $this->config = $config;
        $this->container = $container;
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

        $scope = $this->container->replace(CoreInterface::class, $this);

        $benchmark = $this->benchmark('callAction', $controller . '::' . ($action ?: '~default~'));
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
     */
    public function uri($target, $parameters = [])
    {
        return new Uri($target);
    }
}