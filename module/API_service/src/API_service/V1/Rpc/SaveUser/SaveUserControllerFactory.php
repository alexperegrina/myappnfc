<?php
namespace API_service\V1\Rpc\SaveUser;

class SaveUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        return new SaveUserController($service);
    }
}
