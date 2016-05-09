<?php
namespace myappnfc\V1\Rpc\Login;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class LoginController extends AbstractActionController
{
    public function loginAction()
    {
        return new ViewModel(array(
            'valido' => true,
            'tipo' => 'user',
        ));
    }
}
