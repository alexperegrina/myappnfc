<?php
namespace myappnfc\V1\Rpc\Login;

class LoginControllerFactory
{
    public function __invoke($controllers)
    {
        $authService = $controllers->getServiceLocator()->get('Authenticate\Service\AuthServiceInterface');
        
//        die("hoal");
        return new LoginController($authService);
    }
}
