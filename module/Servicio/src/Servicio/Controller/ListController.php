<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 16:09
 */

namespace Servicio\Controller;

use Servicio\Service\ServicioServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use User\Model\User;

class ListController extends AbstractActionController
{

    /**
     * @var \Servicio\Service\ServicioServiceInterface
     */
    protected $servicioService;

    public function __construct(ServicioServiceInterface $servicioService)
    {
        $this->servicioService = $servicioService;
    }

    public function indexAction()
    {


        //        print_r(getallheaders());
        $a = getallheaders();
        $b = $this->params()->fromQuery('action_name');
        $user = new User();
        $user->setId_user(1);
        $user->setNombre("alex");
        $user->setApellidos("peregrina");
        //print_r($user);
        //print_r((array)$user);
        //print_r(get_object_vars($user));
        $array = json_decode(json_encode($user), true);
        //print_r($array);
        //print_r(get_object_vars($user));
        $arrayObject = get_object_vars($user);
        //print_r($arrayObject);

        print_r($user->toJson());

        $object = array('a' => 1, 'b' => 2, 'c' => 3);
        $c = json_encode($user);
        //print_r($c);
        die();

        return new ViewModel(array(
            'servicios' => $this->servicioService->findAllServicio()
        ));

    }
}