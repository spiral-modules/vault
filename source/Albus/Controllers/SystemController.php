<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Controllers;

use Spiral\Core\Controller;
use Spiral\Security\Traits\AuthorizesTrait;

/**
 * Provides ability to view system logs and snaphots.
 */
class SystemController extends Controller
{
    use AuthorizesTrait;

    public function indexAction()
    {

    }
}