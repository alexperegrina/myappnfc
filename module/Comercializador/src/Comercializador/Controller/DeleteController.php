<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 0:37
 */

namespace Comercializador\Controller;

use Comercializador\Service\ComercializadorServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var \Comercializador\Service\ComercializadorServiceInterface
     */
    protected $comercializadorService;
    
    public function __construct(ComercializadorServiceInterface $comercializadorService)
    {
        $this->comercializadorService = $comercializadorService;
    }

    public function deleteAction()
    {
        try {
            $comercializador = $this->comercializadorService->findComercializador($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('comercializador');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');

            if ($del === 'yes') {
                $this->comercializadorService->deleteComercializador($comercializador);
            }

            return $this->redirect()->toRoute('comercializador');
        }

        return new ViewModel(array(
            'comercializador' => $comercializador
        ));
    }
}