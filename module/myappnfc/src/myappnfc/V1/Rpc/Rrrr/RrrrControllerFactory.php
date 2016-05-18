<?php
namespace myappnfc\V1\Rpc\Rrrr;

class RrrrControllerFactory
{
    public function __invoke($controllers)
    {
        return new RrrrController();
    }
}
