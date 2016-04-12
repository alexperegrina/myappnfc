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

class DeleteController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function deleteAction()
    {
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
            }

            return $this->redirect()->toRoute('user');
        }

        return new ViewModel(array(
            'user' => $user
        ));
    }
}