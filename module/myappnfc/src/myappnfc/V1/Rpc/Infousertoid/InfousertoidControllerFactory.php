<?php
namespace myappnfc\V1\Rpc\Infousertoid;

class InfousertoidControllerFactory
{
    public function __invoke($controllers)
    {
        return new InfousertoidController();
    }
}
