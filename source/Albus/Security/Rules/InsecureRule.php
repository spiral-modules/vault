<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Security\Rules;

use Psr\Log\LogLevel;
use Spiral\Core\Component;
use Spiral\Debug\Traits\LoggerTrait;
use Spiral\Security\ActorInterface;
use Spiral\Security\RuleInterface;

/**
 * Rule with ability to raise alert message on granting access.
 */
class InsecureRule extends Component implements RuleInterface
{
    use LoggerTrait;

    /**
     * Default log level.
     */
    const LEVEL = LogLevel::CRITICAL;

    /**
     * {@inheritdoc}
     */
    public function allows(ActorInterface $actor, $permission, array $context)
    {
        $this->logger()->log(
            static::LEVEL,
            "Actor `{actor}` has been granted insecure access to '{permission}'.", [
                'actor'      => get_class($actor),
                'permission' => $permission
            ]
        );

        return true;
    }
}