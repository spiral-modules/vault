<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */
namespace Spiral\Albus\Controllers;

use Spiral\Albus\AlbusController;

/**
 * No guard check in this sample controller.
 */
class DashboardController extends AlbusController
{
    /**
     * @return string
     */
    public function indexAction()
    {
        return $this->views->render('albus:dashboard');
    }
}