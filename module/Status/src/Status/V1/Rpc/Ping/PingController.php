<?php
namespace Status\V1\Rpc\Ping;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

use User\Model\User;
//use ZF\Hal\Entity;

class PingController extends AbstractActionController
{
    public function pingAction()
    {
//        print_r(getallheaders());
        $a = getallheaders();
        $b = $this->params()->fromQuery('action_name');
        $user = new User();
        $user->setId_user(1);
        $user->setNombre("alex");
        $user->setApellidos("peregrina");
        
        $object = array('a' => 1, 'b' => 2, 'c' => 3);
        $c = json_encode(get_object_vars($user));
        print_r($c);

//        die();
//        $action_name = $this->getEvent()->getRouteMatch()->getParam('action_name');
        return new ViewModel(array(
            'ack' => time(),
//            'action_name' => $action_name
            'test' => $a,
            'params' => $b,
            'user' => json_encode(get_object_vars($user)),
            'user2' => get_object_vars($user),
            'object' => $object,
            'c' => $c,
            'tttt' => $user->toArray()
        ));
    }
}
