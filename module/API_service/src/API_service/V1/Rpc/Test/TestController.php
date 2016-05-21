<?php
namespace API_service\V1\Rpc\Test;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class TestController extends AbstractActionController
{
    public function testAction()
    {
        return new ViewModel(array(
            'ack' => time(),
        ));
    }
}
