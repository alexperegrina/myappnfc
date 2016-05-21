<?php
namespace myappnfc\V1\Rpc\ProfileByUser;

class ProfileByUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        
        return new ProfileByUserController($service);
    }
}
