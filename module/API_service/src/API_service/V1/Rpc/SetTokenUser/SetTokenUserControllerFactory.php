<?php
namespace API_service\V1\Rpc\SetTokenUser;

class SetTokenUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        return new SetTokenUserController($service);
    }
}
