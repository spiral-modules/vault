<?php
/**
 * Spiral Framework.
 *
 * @license MIT
 * @author  Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Configs;

use Spiral\Core\InjectableConfig;

/**
 * Configuration for Albus administration panel.
 */
class Albus extends InjectableConfig
{
    /**
     * Configuration section.
     */
    const CONFIG = 'modules/albus';

    /**
     * @var array
     */
    protected $config = [
    ];
}