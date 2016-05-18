<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19/5/16
 * Time: 0:51
 */

namespace Servicio\Controller;

use Servicio\Service\ServicioServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class ProfileController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $servicioService;

    protected $profileForm;

    public function __construct(ServicioServiceInterface $servicioService)
    {
        $this->servicioService = $servicioService;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function profileAction()
    {
        try {
            $servicio = $this->servicioService->findServicio($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('servicio');
        }

        return new ViewModel(array(
            'user' => $servicio,
//            'profile' => $this->userService->getUserProfile($this->params('id')),
//            'companies' => $this->userService->listUserCompanies($this->params('id')),
//            'services' => $this->userService->listUserServices($this->params('id')),
//            'info_service' => $this->userService->listUserInfoServices($this->params('id')),
//            'tags' => $this->userService->listUserTags($this->params('id'))
        ));
    }

}