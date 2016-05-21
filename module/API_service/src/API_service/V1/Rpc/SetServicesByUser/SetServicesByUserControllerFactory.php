<?php
namespace API_service\V1\Rpc\SetServicesByUser;

class SetServicesByUserControllerFactory
{
    public function __invoke($controllers)
    {
        $userService = $controllers->getServiceLocator()->get('User\Service\UserServiceInterface');
        $servicioService = $controllers->getServiceLocator()->get('Servicio\Service\ServicioServiceInterface');
        return new SetServicesByUserController($userService, $servicioService);
    }
}
