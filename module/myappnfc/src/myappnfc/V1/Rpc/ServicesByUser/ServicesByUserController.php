<?php
namespace myappnfc\V1\Rpc\ServicesByUser;

use Servicio\Service\ServicioServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class ServicesByUserController extends AbstractActionController
{
    protected $servicioService;

    public function __construct(ServicioServiceInterface $servicioService)
    {
        $this->servicioService = $servicioService;
    }
    
    public function servicesByUserAction()
    {
        $username = $this->params()->fromQuery('username');

        $servicesUser = $this->servicioService->findAllServicesByUsername($username);

        return new ViewModel(array(
            'servicios' => $servicesUser,
        ));
    }
}
