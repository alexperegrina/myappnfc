<?php
namespace API_service\V1\Rpc\Login;

class LoginControllerFactory
{
    public function __invoke($controllers)
    {
        $authService = $controllers->getServiceLocator()->get('Authenticate\Service\AuthServiceInterface');
        return new LoginController($authService);
    }
}
