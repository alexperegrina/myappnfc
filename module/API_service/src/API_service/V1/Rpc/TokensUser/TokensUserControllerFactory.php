<?php
namespace API_service\V1\Rpc\TokensUser;

class TokensUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        return new TokensUserController($service);
    }
}
