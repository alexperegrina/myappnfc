<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 18:43
 */

namespace Comercializador\Controller;

use Comercializador\Service\ComercializadorServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    /**
     * @var \Comercializador\Service\ComercializadorServiceInterface
     */
    protected $comercializadorService;
    
    protected $comercializadorForm;

    public function __construct(
        ComercializadorServiceInterface $comercializadorService,
        FormInterface $comercializadorForm
    ) {
        $this->comercializadorService = $comercializadorService;
        $this->comercializadorForm    = $comercializadorForm;
    }

    public function addAction()
    {
        //die("DEBUG");
        
        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->comercializadorForm->setData($request->getPost());

            if ($this->comercializadorForm->isValid()) {
                try {
                    
                    $this->comercializadorService->saveComercializador($this->comercializadorForm->getData());
                    
                    return $this->redirect()->toRoute('comercializador');
                } catch (\Exception $e) {
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->comercializadorForm
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $comercializador    = $this->comercializadorService->findComercializador($this->params('id'));

        $this->comercializadorForm->bind($comercializador);

        if ($request->isPost()) {
            $this->comercializadorForm->setData($request->getPost());

            if ($this->comercializadorForm->isValid()) {
                try {
                    
                    $this->comercializadorService->saveComercializador($comercializador);

                    return $this->redirect()->toRoute('comercializador');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->comercializadorForm
        ));
    }

    public function signinAction() {
        $error = "";

        $request = $this->getRequest();

        if ($request->isPost()) {

            $this->comercializadorForm->setData($request->getPost());

            if ($this->comercializadorForm->isValid()) {
                //comprovamos que ya exista un usuario con este username


//                print_r(false);die();
                if(!$this->comercializadorService->usernamevalid(
                    $this->comercializadorForm->getData()->getUsername())) {
//                    die("dentro de error");
                    $error = "El username ya es utilizado";

                }
                else {
                    try {

                        //encriptamos el password
                        $passwordOld = $this->comercializadorForm->getData()->getPassword();
                        $passwordNew = md5($passwordOld);
                        $this->comercializadorForm->getData()->setPassword($passwordNew);

                        $this->comercializadorService->saveComercializador($this->comercializadorForm->getData());

                        return $this->redirect()->toRoute('authenticate');
                    } catch (\Exception $e) {
                        // Some DB Error happened, log it and let the user know
                        die($e->getMessage());
                    }
                }
            }
        }

        $this->comercializadorForm->get('submit')->setValue('Sign In');

        return new ViewModel(array(
            'form' => $this->comercializadorForm,
            'error' => $error
        ));
    }
    
}