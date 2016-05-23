<?php
namespace API_service\V1\Rpc\SetTokenUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Service\UserServiceInterface;

class SetTokenUserController extends AbstractActionController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function setTokenUserAction()
    {
        $data = $this->bodyParams();
        $username = $data['username'];
        $token = $data['token'];

        $user = $this->userService->findUserByUsername($username);
        
        try {
            $this->userService->addPrivateKey($user, $token);
        } catch(\Exception $e) {
            return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(400, $e->getMessage())
            );
        }
        return new ViewModel(array(
            'response' => true,
        ));
    }
}
