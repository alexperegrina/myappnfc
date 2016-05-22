<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:29
 */

namespace User\Controller;

use User\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Authenticate\Service\AuthServiceInterface;

class DeleteController extends AbstractActionController
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

    public function deleteAction()
    {
        $this->redirectUserNormal($this->params('id'));
        
        try {
            $user = $this->userService->findUser($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('user');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            $del = $request->getPost('delete_confirmation', 'no');

            if ($del === 'yes') {
                $this->userService->deleteUser($user);
                $this->authService->clear();
            }

            return $this->redirect()->toRoute('authenticate');
        }

        return new ViewModel(array(
            'user' => $user
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
    }
}