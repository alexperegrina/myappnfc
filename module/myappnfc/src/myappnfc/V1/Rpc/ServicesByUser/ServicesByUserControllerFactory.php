<?php
namespace myappnfc\V1\Rpc\ServicesByUser;

class ServicesByUserControllerFactory
{
    public function __invoke($controllers)
    {
        $service = $controllers->getServiceLocator()->get('Servicio\Service\ServicioServiceInterface');
        return new ServicesByUserController($service);
    }
}
