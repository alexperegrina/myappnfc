<?php
namespace myappnfc\V1\Rpc\SaveUser;

class SaveUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        return new SaveUserController($service);
    }
}
