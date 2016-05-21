<?php
namespace API_service\V1\Rpc\Test;

class TestControllerFactory
{
    public function __invoke($controllers)
    {
        return new TestController();
    }
}
