<?php
namespace myappnfc\V1\Rpc\SetServicesByUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use Servicio\Service\ServicioServiceInterface;
use User\Service\UserServiceInterface;

class SetServicesByUserController extends AbstractActionController
{

    protected $userService;
    protected $servicioService;

    public function __construct(UserServiceInterface $userService, ServicioServiceInterface $servicioService)
    {
        $this->servicioService = $servicioService;
        $this->userService = $userService;
    }

    public function setServicesByUserAction()
    {
        $data = $this->bodyParams();
        $username = $data['username'];
        $servicios = $data['servicios'];


        $serviciosArray = array();
        foreach ($servicios AS $servicio) {

            $servicioJson = json_decode($servicio, true);
            
            if($servicioJson['activado']) {
                try {
                    $servicioObject = $this->servicioService->findServiceByUsername($servicioJson['username']);
                    $serviciosArray[] = $servicioObject->getId();
                } catch(\Exception $e) {
                    return new \ZF\ApiProblem\ApiProblemResponse(
                        new \ZF\ApiProblem\ApiProblem(400, 'Error al guardar los permisos en la BD')
                    );
                }
            }
        }
        
        $this->userService->replacePermisionServices($username, $serviciosArray);

        return new ViewModel(array(
            'response' => true,
        ));
    }
}
