<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Vault\Controllers;

use Spiral\Core\Controller;
use Spiral\Vault\Controllers\Grids\SampleSource;
use Spiral\Vault\Controllers\Requests\WelcomeRequest;

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
        return $this->views->render('vault:welcome/index');
    }

    /**
     * @return string
     */
    public function visualsAction()
    {
        return $this->views->render('vault:welcome/visuals', [
            'grid' => (new SampleSource())->paginate(2)
        ]);
    }

    /**
     * @param WelcomeRequest $request
     *
     * @return array
     */
    public function submitAction(WelcomeRequest $request)
    {
        if (!$request->isValid()) {
            return [
                'status' => 400,
                'errors' => $request->getErrors()
            ];
        }

        return [
            'status'  => 200,
            'message' => 'All good!'
        ];
    }
}
