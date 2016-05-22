<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 23:53
 */

namespace User\Controller;

use User\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Authenticate\Service\AuthServiceInterface;
//use Authenticate\Model\Session;

class ListController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    protected $authService;

    public function __construct(UserServiceInterface $userService, AuthServiceInterface $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    public function indexAction()
    {
        $this->redirectUserNormal();
        
        return new ViewModel(array(
            'users' => $this->userService->findAllUser()
        ));
    }

    private function redirectUserNormal() {
        if (!$this->authService->logged()) {
            return $this->redirect()->toRoute('authenticate');
        }

        $session = $this->authService->getSession();
        $user = $this->userService->findUserByUsername($session->getUsername());

        if($user->getTipo() != 'admin') {
            $this->authService->redireccionByType($this, $user->getId(), $user->getTipo());
        }
    }
}