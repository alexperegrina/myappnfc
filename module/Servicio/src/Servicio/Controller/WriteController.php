<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 20:50
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

    public function signinAction() {
        $error = "";

        $request = $this->getRequest();

        if ($request->isPost()) {

            $this->servicioForm->setData($request->getPost());

            if ($this->servicioForm->isValid()) {
                //comprovamos que ya exista un usuario con este username


//                print_r(false);die();
                if(!$this->servicioService->usernameValid(
                    $this->servicioForm->getData()->getUsername())) {
//                    die("dentro de error");
                    $error = "El username ya es utilizado";
                }
                else {
                    try {

//                        //encriptamos el password
//                        $passwordOld = $this->servicioForm->getData()->getPassword();
//                        $passwordNew = md5($passwordOld);
//                        $this->servicioForm->getData()->setPassword($passwordNew);

                        $this->servicioService->saveServicio($this->servicioForm->getData());

                        return $this->redirect()->toRoute('authenticate');
                    } catch (\Exception $e) {
                        // Some DB Error happened, log it and let the user know
                        die($e->getMessage());
                    }
                }
            }
        }

        $this->servicioForm->get('submit')->setValue('Sign In');

        return new ViewModel(array(
            'form' => $this->servicioForm,
            'error' => $error
        ));
    }
    
}