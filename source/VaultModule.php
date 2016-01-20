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
            __DIR__ . '/config/vault.php',
            $directories->directory('config') . 'modules/vault.php',
            PublisherInterface::FOLLOW
        );

        /**
         * Publishing all module visual resources. We are going to overwrite existed files.
         */
        $publisher->publishDirectory(
            __DIR__ . '/../resources',                        //Profiler js, css and modules
            $directories->directory('public') . 'resources',  //Expected directory in webroot
            PublisherInterface::OVERWRITE                     //We can safely overwrite resources
        );
    }
}