<?php
namespace myappnfc\V1\Rpc\ServicesByUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Service\UserServiceInterface;
use User\Model\User;

class ServicesByUserController extends AbstractActionController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    
    public function servicesByUserAction()
    {
        $username = $this->params()->fromQuery('username');

        /**
         * @var User
         */
        $user = $this->userService->findUserByUsername($username);

        return new ViewModel(array(
            'user' => $user->toArray(),
        ));
    }
}
