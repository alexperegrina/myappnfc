<?php
namespace API_service\V1\Rpc\ProfileByUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Service\UserServiceInterface;
use User\Model\User;
use Servicio\Service\ServicioServiceInterface;

class ProfileByUserController extends AbstractActionController
{
    protected $userService;

    protected $servicioService;

    public function __construct(UserServiceInterface $userService, ServicioServiceInterface $servicioService)
    {
        $this->userService = $userService;
        $this->servicioService = $servicioService;
    }

    public function profileByUserAction()
    {
        $userUsername = $this->params()->fromQuery('username');
        $servicioUsername = $this->getUsernameService();
        
        //comprobamos que el servicio tenga permiso para consultar la información del usuario
        $permiso = $this->servicioService->serviceUserHasPermission($userUsername, $servicioUsername);
        if(!$permiso) {
            return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(400,
                    'El servicio no tiene autorización para consultar la información de este usuario')
            );
        }
        
        /**
         * @var User
         */
        $user = $this->userService->findUserByUsername($userUsername);

        return new ViewModel(array(
            'user' => $user->toArray(),
        ));
    }

    private function getUsernameService() {
        $param = $this->params()->fromHeader('Authorization')->getFieldValue();
        $encript = explode(" ", $param)[1];
        $decode = base64_decode($encript);
        $usernameService = explode(":", $decode)[0];
        return $usernameService;
    }
}
