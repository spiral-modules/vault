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
use Spiral\Core\Exceptions\ControllerException;
use Spiral\Core\HMVC\CoreInterface;
use Spiral\Http\Uri;
use Spiral\Security\GuardInterface;

/**
 * Albus core aggregates
 */
class AlbusCore implements CoreInterface
{
    /**
     * @var AlbusConfig
     */
    private $config = null;

    /**
     * @var GuardInterface
     */
    private $guard = null;

    public function __construct(AlbusConfig $config, GuardInterface $guard)
    {
        $this->config = $config;
        $this->guard = $guard;
    }

    /**
     * {@inheritdoc}
     */
    public function callAction($controller, $action = '', array $parameters = [])
    {
        if (!$this->guard->allows('albus', compact('controller', 'action'))) {
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