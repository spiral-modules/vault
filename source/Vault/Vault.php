<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault;

use Spiral\Core\Component;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Core\Exceptions\ControllerException;
use Spiral\Core\HMVC\CoreInterface;
use Spiral\Security\Traits\GuardedTrait;
use Spiral\Translator\Traits\TranslatorTrait;
use Spiral\Vault\Configs\VaultConfig;

/**
 * Vault Core provides ability to whitelist controllers, map their short names and aliases into
 * specific class and automatically check Actor permission to execute any of controller actions.
 */
class Vault extends Component implements CoreInterface, SingletonInterface
{
    use GuardedTrait, TranslatorTrait;

    /**
     * @var VaultConfig
     */
    private $config = null;

    /**
     * @var VaultRoute
     */
    private $route;

    /**
     * @var CoreInterface
     */
    protected $app = null;

    /**
     * @param VaultConfig   $config
     * @param VaultRoute    $route
     * @param CoreInterface $app User application.
     */
    public function __construct(VaultConfig $config, VaultRoute $route, CoreInterface $app)
    {
        $this->config = $config;
        $this->route = $route;
        $this->app = $app;
    }

    /**
     * @return VaultRoute
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return VaultConfig
     */
    public function getConfig(): VaultConfig
    {
        return $this->config;
    }

    /**
     * {@inheritdoc}
     */
    public function callAction(
        string $controller,
        string $action = null,
        array $parameters = [],
        array $scope = []
    ) {
        if (!$this->config->hasController($controller)) {
            throw new ControllerException(
                "Undefined vault controller '{$controller}'",
                ControllerException::NOT_FOUND
            );
        }

        $actionPermission = "{$this->config->guardNamespace()}.{$controller}";

        if (!$this->getGuard()->allows($actionPermission, compact('action'))) {
            throw new ControllerException(
                "Unreachable vault controller '{$controller}'",
                ControllerException::FORBIDDEN
            );
        }

        //Delegate controller call to real application
        return $this->app->callAction(
            $this->config->controllerClass($controller),
            $action,
            $parameters,
            $scope
        );
    }

//    /**
//     * Get vault specific uri.
//     *
//     * @param string      $target Target controller and action in a form of "controller::action" or
//     *                            "controller:action" or "controller".
//     * @param array|mixed $parameters
//     *
//     * @return UriInterface
//     * @throws VaultException
//     */
//    public function uri($target, $parameters = [])
//    {
//        $controller = $action = '';
//        if (strpos($target, ':') !== false) {
//            list($controller, $action) = explode(':', $target);
//        } else {
//            $controller = $target;
//
//            if (!empty($parameters)) {
//                throw new VaultException(
//                    "Unable to generate uri with empty controller action and not empty parameters."
//                );
//            }
//        }
//
//        if (!isset($this->config->controllers()[$controller])) {
//            throw new VaultException(
//                "Unable to generate uri, undefined controller '{$controller}'."
//            );
//        }
//
//        return $this->route->withDefaults(compact('controller', 'action'))->uri($parameters);
//    }
}
