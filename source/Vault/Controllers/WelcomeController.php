<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Controllers;

use Spiral\Core\Controller;

/**
 * No guard check in this sample controller.
 */
class WelcomeController extends Controller
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return $this->views->render('vault:welcome');
    }
}
