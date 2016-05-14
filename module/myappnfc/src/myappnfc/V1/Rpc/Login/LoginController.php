<?php
namespace myappnfc\V1\Rpc\Login;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use Authenticate\Service\AuthServiceInterface;

class LoginController extends AbstractActionController
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }
    public function loginAction()
    {
        $user = $this->params()->fromQuery('user');
        $password = $this->params()->fromQuery('password');

        $valido = $this->authService->isValid($user, $password);

        if($valido) {
            $user2 = $this->authService->getUserRow();
            $tipo = $user2->tipo;
        }

        return new ViewModel(array(
            'valido' => $valido,
            'tipo' => $tipo,
        ));
    }
}
