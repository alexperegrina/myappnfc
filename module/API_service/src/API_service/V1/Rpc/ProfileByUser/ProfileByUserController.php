<?php
namespace API_service\V1\Rpc\ProfileByUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Service\UserServiceInterface;
use User\Model\User;

class ProfileByUserController extends AbstractActionController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function profileByUserAction()
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
