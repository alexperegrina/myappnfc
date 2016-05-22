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
use User\Service\UserServiceInterface;

class AuthController extends AbstractActionController
{
    protected $authService;

    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    //we will inject authService via factory
    public function __construct(AuthServiceInterface $authService, UserServiceInterface $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

    public function indexAction()
    {



//        if ($this->authService->logged()) {
//            return $this->redirect()->toRoute('authenticate/success');
//        }
        $this->personalRedirect();

        $form = $this->getServiceLocator()
            ->get('FormElementManager')
            ->get('Authenticate\Form\LoginForm');
        $viewModel = new ViewModel();

        //initialize error...
        $viewModel->setVariable('error', '');
        //authentication block...
        $this->authenticate($form, $viewModel);

        $viewModel->setVariable('form', $form);

//        $viewModel->setTemplate('layout/auth');
        $this->layout('layout/auth');

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

                    /**
                     * @var \User\Model\UserInterface
                     */
                    $user = $this->authService->getUserRow();

                    $this->authService->write(
                        $user->id,
                        $dataform['username'],
                        $this->getRequest()->getServer('REMOTE_ADDR'),
                        $request->getServer('HTTP_USER_AGENT')
                    );
                    
                    $this->authService->redireccionByType($this, $user->id, $user->tipo);

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

    private function personalRedirect()
    {

        if ($this->authService->logged()) {
            $session = $this->authService->getSession();
            $user = $this->userService->findUserByUsername($session->getUsername());

            if($user->getTipo() != 'admin') {
//            die($user->getId());
                $this->authService->redireccionByType($this, $user->getId(), $user->getTipo());
            }
            else {
                return $this->redirect()->toRoute('user');
            }
        }
    }
}