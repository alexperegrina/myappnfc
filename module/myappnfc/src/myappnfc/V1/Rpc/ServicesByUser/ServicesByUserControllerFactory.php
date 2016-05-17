<?php
namespace myappnfc\V1\Rpc\ServicesByUser;

class ServicesByUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');

        return new ProfileByUserController($service);
    }
}
