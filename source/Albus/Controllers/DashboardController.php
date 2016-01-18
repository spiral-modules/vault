<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Controllers;

use Spiral\Core\Controller;
use Spiral\Views\ViewsInterface;

/**
 * No guard check in this sample controller.
 */
class DashboardController extends Controller
{
    /**
     * @param ViewsInterface $views
     * @return string
     */
    public function indexAction(ViewsInterface $views)
    {
        return $views->render('albus:controllers/dashboard');
    }
}