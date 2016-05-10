<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/4/16
 * Time: 18:47
 */

/**
 * This is a controller that place a Login Form and authentication service.
 */

namespace Authenticate\Controller;

use Authenticate\Service\AuthServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    protected $authService;

    //we will inject authService via factory
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function indexAction()
    {

        if ($this->authService->logged()) {
            return $this->redirect()->toRoute('authenticate/success');
        }

        $form = $this->getServiceLocator()
            ->get('FormElementManager')
            ->get('Authenticate\Form\LoginForm');
        $viewModel = new ViewModel();

        //initialize error...
        $viewModel->setVariable('error', '');
        //authentication block...
        $this->authenticate($form, $viewModel);

        $viewModel->setVariable('form', $form);

        return $viewModel;
    }


    protected function authenticate($form, $viewModel)
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $dataform = $form->getData();

                if ($this->authService->isValid($dataform['username'], $dataform['password'])) {
                    //authentication success
                    $user = $this->authService->getUserRow();

                    $this->authService->write(
                        $user->id,
                        $dataform['username'],
                        $this->getRequest()->getServer('REMOTE_ADDR'),
                        $request->getServer('HTTP_USER_AGENT')
                    );

                    /**
                     * Aqui hay que hacer el routing segun el tipo de usuario
                     *
                     * $user->tipo = {user, service, comercializador}
                     */
                    return $this->redirect()->toRoute('authenticate/success');
                    //return $this->redirect()->toRoute('success', array('action' => 'index'));
                } else {
                    $viewModel->setVariable('error', 'Login Error');
                }
            }
        }
    }

    public function logoutAction()
    {
        $this->authService->clear();
        return $this->redirect()->toRoute('authenticate');
    }
}