<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/5/16
 * Time: 23:43
 */

namespace Authenticate\Service;

use Zend\Mvc\Controller\AbstractActionController;


interface AuthServiceInterface
{

    /**
     * Comprueba si hay algun usuario registrado
     *
     * @return boolean
     */
    public function logged();


//    public function read($id);

//    public function getSessionId();

//    public function setUserPassword($user, $password);

//    public function authenticate() ;

    /**
     * Comprueba su el usuario y password estan en el sistema y son validos
     *
     * @param String $user
     * @param String $password
     * @return boolean
     */
    public function isValid($user, $password);

    /**
     * Coje la fila completa de la tabla de user del usuario que esta logeado en el sistema
     *
     * @return Row del User
     */
    public function getUserRow();

    /**
     * Requistra en el modulo de autentificación el usuario 
     *
     * @param int $id
     * @param String $username
     * @param $ip ip del usuario
     * @param $userAgent 
     */
    public function write($id, $username, $ip, $userAgent);

    /**
     * Limpiamos la sesión para el usuario que hace logout
     * 
     * @return mixed
     */
    public function clear();

    /**
     * @param AbstractActionController $controller
     * @param $type
     * @return mixed
     */
    public function redireccionByType(AbstractActionController $controller, $type);
    
    
}