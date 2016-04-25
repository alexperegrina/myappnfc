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

class ProfileController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function profileAction()
    {
        try {
            $user = $this->userService->findUser($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('user');
        }
        
        return new ViewModel(array(
            'user' => $user
        ));
    }
}