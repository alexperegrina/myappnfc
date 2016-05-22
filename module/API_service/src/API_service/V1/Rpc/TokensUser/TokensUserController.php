<?php
namespace API_service\V1\Rpc\TokensUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Model\User;
use User\Service\UserServiceInterface;

class TokensUserController extends AbstractActionController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function tokensUserAction()
    {
        $username = $this->params()->fromQuery('username');
        return new ViewModel(array(
            'tokens' => $this->userService->findKeysByUsername($username),
        ));
    }
}
