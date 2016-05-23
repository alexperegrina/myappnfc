<?php
/**
 * Created by PhpStorm.
 * User: irinavasilieva
 * Date: 23/04/16
 * Time: 12:49
 */
namespace User\Controller;

use User\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Authenticate\Service\AuthServiceInterface;

class ProfileController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    //protected $profileForm;

    protected $authService;

    public function __construct(UserServiceInterface $userService, AuthServiceInterface $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function profileAction()
    {
        
        $tipo = $this->redirectUserNormal($this->params('id'));
        
        if($tipo != 'admin') {
            $this->layout('layout/user');
        }

        try {
            $user = $this->userService->findUser($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('user');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            print_r($request->getContent());
            if (!is_null($request->getPost('tag'))) $this->userService->addItem($user->getId(), $request->getPost());
            if (!is_null($request->getPost('cambiar_estado'))) {
                if ($request->getPost() == "Active") $this->userService->changeServiceStatus($user->getUsername(), [79, 0]);
                else $this->userService->changeServiceStatus($user->getUsername(), [79, 1]);
            }
        }
            //return $this->redirect()->toRoute('user/profile');

        return new ViewModel(array(
            'user' => $user,
            'profile' => $this->userService->getUserProfile($user->getId()),
            'companies' => $this->userService->listUserCompanies($user->getId()),
            'services' => $this->userService->listUserServices($user->getId()),
            'info_service' => $this->userService->listUserInfoServices($user->getId()),
            'tags' => $this->userService->listUserTags($user->getId())
        ));
    }

    private function redirectUserNormal($id) {
        
        if (!$this->authService->logged()) {
            return $this->redirect()->toRoute('authenticate');
        }

        $session = $this->authService->getSession();
        $user = $this->userService->findUserByUsername($session->getUsername());
        
        if($user->getTipo() != 'admin' && $id != $user->getId()) {
            $this->authService->redireccionByType($this, $user->getId(), $user->getTipo());
        }
        
        return $user->getTipo();
    }
    
}