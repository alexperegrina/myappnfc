<?php
namespace myappnfc\V1\Rpc\Login;

class LoginControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoginController();
    }
}
