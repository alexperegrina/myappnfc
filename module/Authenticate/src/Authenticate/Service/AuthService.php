<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/5/16
 * Time: 19:05
 */

namespace Authenticate\Service;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;


class AuthService implements AuthServiceInterface
{
    /**
     * @var \Zend\Authentication\AuthenticationService
     */
    protected $authService;

    /**
     * AuthService constructor.
     * @param AuthenticationService $authService
     */
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * {@inheritDoc}
     */
    public function logged() 
    {
        return $this->authService->getStorage()->getSessionManager()
            ->getSaveHandler()
            ->read($this->authService->getStorage()->getSessionId());
    }

//    public function read($id) 
//    {
//        $this->authService->getStorage()->getSessionManager()
//            ->getSaveHandler()
//            ->read($id);
//    }
    
//    public function getSessionId() 
//    {
//        return $this->authService->getStorage()->getSessionId();
//    }
    
//    public function setUserPassword($user, $password) 
//    {
//
//    }
    
//    public function authenticate() {
//
//    }

    /**
     * {@inheritDoc}
     */
    public function isValid($user, $password) 
    {
        $this->authService->getAdapter()
            ->setIdentity($user)
            ->setCredential($password);
        $result = $this->authService->authenticate();

        return $result->isValid();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserRow() 
    {
        return $resultRow = $this->authService->getAdapter()->getResultRowObject();
    }

    /**
     * {@inheritDoc}
     */
    public function write($id, $username, $ip, $userAgent) 
    {
        $this->authService->getStorage()->write(
            array(
                'id'            => $id,
                'username'      => $username,
                'ip_address'    => $ip,
                'user_agent'    => $userAgent
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function clear() {
        $this->authService->getStorage()->clear();
    }

    /**
     * {@inheritDoc}
     */
    public function redireccionByType(AbstractActionController $controller, $idUser, $type)
    {
        switch ($type) {
            case "comercializador":
                $controller->redirect()->toRoute('comercializador/profile', array('id'=>$idUser));
                break;
            case "user":
                $controller->redirect()->toRoute('user/profile', array('id'=>$idUser));
                break;
            case "servicio":
                $controller->redirect()->toRoute('servicio/profile', array('id'=>$idUser));
                break;
        }
    }
}