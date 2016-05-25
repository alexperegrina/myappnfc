<?php
namespace API_service\V1\Rpc\TokensUserById;

class TokensUserByIdControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        return new TokensUserByIdController($service);
    }
}
