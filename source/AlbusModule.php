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

class AlbusModule implements ModuleInterface
{
    /**
     * @param RegistratorInterface $registrator
     */
    public function register(RegistratorInterface $registrator)
    {
        $registrator->configure('views', 'namespaces', 'spiral/albus', [
            "'albus' => [",
            "   directory('libraries') . 'spiral/albus/source/views/',",
            "   /*{{namespaces.albus}}*/",
            "]"
        ]);

        $registrator->configure('translator', 'namespaces', 'spiral/albus', [
            "'albus' => [",
            "   'spiral-albus-*',",
            "   'view-albus-*',",
            "   /*{{domain.albus}}*/",
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
            __DIR__ . '/config/albus.php',
            $directories->directory('config') . 'modules/albus.php',
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