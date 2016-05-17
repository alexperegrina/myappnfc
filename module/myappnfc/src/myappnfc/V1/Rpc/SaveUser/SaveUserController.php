<?php
namespace myappnfc\V1\Rpc\SaveUser;

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

        $id = $this->params()->fromQuery('id');
        $username = $this->params()->fromQuery('username');
        $password = $this->params()->fromQuery('password');
        $mail = $this->params()->fromQuery('mail');
//        $id_user = $this->params()->fromQuery('id_user');
        $nombre = $this->params()->fromQuery('nombre');
        $apellidos = $this->params()->fromQuery('apellidos');
        $fecha_nacimiento = $this->params()->fromQuery('fecha_nacimiento');



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
