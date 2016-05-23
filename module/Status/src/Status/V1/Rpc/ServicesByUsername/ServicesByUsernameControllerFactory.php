<?php
namespace Status\V1\Rpc\ServicesByUsername;

class ServicesByUsernameControllerFactory
{
    public function __invoke($controllers)
    {
        return new ServicesByUsernameController();
    }
}
