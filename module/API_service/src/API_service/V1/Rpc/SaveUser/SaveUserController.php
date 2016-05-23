<?php
namespace API_service\V1\Rpc\SaveUser;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use User\Model\User;
use User\Service\UserServiceInterface;

class SaveUserController extends AbstractActionController
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function saveUserAction()
    {
        /**
         * Cojemos lo parametros de entrada
         */
        $data = $this->bodyParams();

        $id = $data['id'];
        $username = $data['username'];
        $password = $data['password'];
        $mail = $data['mail'];
//        $id_user = $this->params()->fromQuery('id_user');
        $nombre = $data['nombre'];
        $apellidos = $data['apellidos'];
        $fecha_nacimiento = $data['fecha_nacimiento'];

        /**
         * Creamos el usuario
         */
        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setMail($mail);
        $user->setId_user($id); // --> Esto hay que quitarlo cuando irina cambie todo el codigo.
        $user->setNombre($nombre);
        $user->setApellidos($apellidos);
        $user->setFecha_nacimiento($fecha_nacimiento);


        try {
            $this->userService->saveUser($user);
        } catch (\Exception $e) {
            return new \ZF\ApiProblem\ApiProblemResponse(
                new \ZF\ApiProblem\ApiProblem(400, 'Error al guardar el usuario en la BD')
            );
        }

        return new ViewModel(array(
            'response' => true,
        ));
    }
}
