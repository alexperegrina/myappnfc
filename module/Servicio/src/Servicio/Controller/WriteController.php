<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 18:43
 */

namespace Servicio\Controller;

use Servicio\Service\ServicioServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    /**
     * @var \Servicio\Service\ServicioServiceInterface
     */
    protected $servicioService;
    
    protected $servicioForm;

    public function __construct(
        ServicioServiceInterface $servicioService,
        FormInterface $servicioForm
    ) {
        $this->servicioService = $servicioService;
        $this->servicioForm    = $servicioForm;
    }

    public function addAction()
    {
        //die("DEBUG");
        
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->servicioForm->setData($request->getPost());

            if ($this->servicioForm->isValid()) {
                try {
                    
                    $this->servicioService->saveServicio($this->servicioForm->getData());
                    
                    return $this->redirect()->toRoute('servicio');
                } catch (\Exception $e) {
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->servicioForm
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $servicio    = $this->servicioService->findServicio($this->params('id'));

        $this->servicioForm->bind($servicio);

        if ($request->isPost()) {
            $this->servicioForm->setData($request->getPost());

            if ($this->servicioForm->isValid()) {
                try {
                    $this->servicioService->saveServicio($servicio);

                    return $this->redirect()->toRoute('servicio');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->servicioForm
        ));
    }
    
}