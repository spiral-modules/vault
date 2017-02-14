<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Spiral\Http\Routing\AbstractRoute;
use Spiral\Http\Routing\Traits\CoreTrait;

/**
 * Route similar to Controllers route but without controller namespace mapping.
 */
class VaultRoute extends AbstractRoute
{
    use CoreTrait;

    /**
     * @param string $name
     * @param string $pattern
     * @param array  $defaults
     */
    public function __construct(string $name, string $pattern, array $defaults)
    {
        parent::__construct($name, $defaults);
        $this->pattern = $pattern;
    }

    /**
     * {@inheritdoc}
     */
    protected function createEndpoint(): callable
    {
        $route = $this;

        return function (Request $request, Response $response) use ($route) {
            $matches = $this->getMatches();

            return $this->callAction(
                $matches['controller'],
                $matches['action'],
                $matches,
                [Request::class => $request, Response::class => $response]
            );
        };
    }
}