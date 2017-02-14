<?php
/**
 * spiral
 *
 * @author    Wolfy-J
 */

namespace TestApplication\Controllers;

use Spiral\Core\Controller;

class VaultController extends Controller
{
    public function indexAction()
    {
        return "Hello, Dave.";
    }

    public function testRender()
    {
        return $this->views->render('test');
    }
}