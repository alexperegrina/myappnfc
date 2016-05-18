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
        $this->servicioService->findAllServicesByUsername("alex");
        return new ViewModel(array(
            'servicios' => $this->servicioService->findAllServicio(),
        ));
    }
}
