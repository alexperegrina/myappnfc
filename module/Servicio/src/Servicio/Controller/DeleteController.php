<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 20:53
 */

namespace Servicio\Controller;

use Servicio\Service\ServicioServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController
{
    /**
     * @var \Servicio\Service\ServicioServiceInterface
     */
    protected $servicioService;
    
    public function __construct(ServicioServiceInterface $servicioService)
    {
        $this->servicioService = $servicioService;
    }

    public function deleteAction()
    {
        try {
            $servicio = $this->servicioService->findServicio($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('servicio');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');

            if ($del === 'yes') {
                $this->servicioService->deleteServicio($servicio);
            }

            return $this->redirect()->toRoute('servicio');
        }

        return new ViewModel(array(
            'servicio' => $servicio
        ));
    }
}