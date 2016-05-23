<?php
namespace myappnfc\V1\Rpc\Infousertoid;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

use User\Model\User;

class InfousertoidController extends AbstractActionController
{
    public function infousertoidAction()
    {
        $id = $this->params()->fromQuery('id');
        
        $user = new User();
        $user->setId_user(1);
        $user->setNombre("alex");
        $user->setApellidos("peregrina");
        $user->setFecha_nacimiento("26/11/89");
        $user->setMail("alexperegrina@gmail.com");

        return new ViewModel(array(
            'user' => $user->toArray(),
        ));
    }
}
