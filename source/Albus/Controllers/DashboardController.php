<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Controllers;

use Spiral\Core\Controller;

/**
 * No guard check in this sample controller.
 */
class DashboardController extends Controller
{
    /**
     * @return string
     */
    public function indexAction()
    {
        $this->views->render('albus:controllers/dashboard');
    }
}