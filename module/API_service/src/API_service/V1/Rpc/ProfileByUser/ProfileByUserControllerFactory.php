<?php
namespace API_service\V1\Rpc\ProfileByUser;

class ProfileByUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        return new ProfileByUserController($service);
    }
}
