<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral;

use Spiral\Core\DirectoriesInterface;
use Spiral\Modules\ModuleInterface;
use Spiral\Modules\PublisherInterface;
use Spiral\Modules\RegistratorInterface;

class VaultModule implements ModuleInterface
{
    /**
     * @param RegistratorInterface $registrator
     */
    public function register(RegistratorInterface $registrator)
    {
        $registrator->configure('views', 'namespaces', 'spiral/vault', [
            "'vault' => [",
            "   directory('application') . 'views/vault/',",
            "   directory('libraries') . 'spiral/vault/source/views/',",
            "   /*{{namespaces.vault}}*/",
            "]"
        ]);

        $registrator->configure('translator', 'domains', 'spiral/vault', [
            "'vault' => [",
            "   'spiral-vault-*',",
            "   'view-vault-*',",
            "   /*{{domain.vault}}*/",
            "]"
        ]);
    }

    /**
     * @param PublisherInterface   $publisher
     * @param DirectoriesInterface $directories
     */
    public function publish(PublisherInterface $publisher, DirectoriesInterface $directories)
    {
        $publisher->publish(
            __DIR__ . '/../resources/config.php',
            $directories->directory('config') . 'modules/vault.php',
            PublisherInterface::FOLLOW
        );

        $publisher->publish(
            __DIR__ . '/views/layout.dark.php',
            $directories->directory('application') . '/views/vault/layout.dark.php',
            PublisherInterface::FOLLOW
        );

        $publisher->publishDirectory(
            __DIR__ . '/../resources',
            $directories->directory('public') . 'resources',
            PublisherInterface::OVERWRITE
        );
    }
}
