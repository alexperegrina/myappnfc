<?php
namespace API_service\V1\Rpc\TokensUserById;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Service\UserServiceInterface;
use User\Model\User;

class TokensUserByIdController extends AbstractActionController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }
    
    public function tokensUserByIdAction()
    {
        $id = $this->params()->fromQuery('id');

        $user = $this->userService->findUserByIdNFC($id);

        $tokens = $this->userService->findKeysByUsername($user->getUsername());

        return new ViewModel(array(
            'tokens' => $tokens,
        ));
    }
}
