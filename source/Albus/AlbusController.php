<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus;

use Spiral\Core\Controller;
use Spiral\Debug\Traits\LoggerTrait;
use Spiral\Security\Traits\AuthorizesTrait;

/**
 * Automatically forces controller permissions namespace to albus.
 */
abstract class AlbusController extends Controller
{
    use AuthorizesTrait, LoggerTrait;

    const GUARD_NAMESPACE = 'albus';
}