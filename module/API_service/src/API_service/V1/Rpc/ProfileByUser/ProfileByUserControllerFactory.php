<?php
namespace API_service\V1\Rpc\ProfileByUser;

class ProfileByUserControllerFactory
{
    public function __invoke($controllers)
    {
        $userService = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        $serviceService = $controllers->getServiceLocator()->get('Servicio\Service\ServicioServiceInterface');
        return new ProfileByUserController($userService, $serviceService);
    }
}
