<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/5/16
 * Time: 21:10
 */

namespace Comercializador\Controller;

use Rhumsaa\Uuid\Uuid;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Comercializador\Service\ComercializadorServiceInterface;


class ProfileController extends AbstractActionController
{

    /**
     * @var \Comercializador\Service\ComercializadorServiceInterface
     */
    protected $comercializadorService;

    protected $profileForm;

    public function __construct(ComercializadorServiceInterface $comercializadorService)
    {
        $this->comercializadorService = $comercializadorService;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function profileAction()
    {
        $this->layout('layout/comercializador');

//        $id = uniqid();
//        $variable = microtime() + "alias";
//        $id2 = Uuid::uuid5(Uuid::NAMESPACE_DNS, $variable)->toString();

        try {
            $comercializador = $this->comercializadorService->findComercializador($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('comercializador');
        }
        
        $ids = $this->comercializadorService->findIdsComercializador($comercializador);

        return new ViewModel(array(
            'user'  => $comercializador,
            'ids'   => $ids
//            'profile' => $this->userService->getUserProfile($this->params('id')),
//            'companies' => $this->userService->listUserCompanies($this->params('id')),
//            'services' => $this->userService->listUserServices($this->params('id'))
        ));
    }

    


    /*public function editAction()
    {

        $request = $this->getRequest();
        $user    = $this->userService->findUser($this->params('id'));

        $this->profileForm->bind($user);

        if ($request->isPost()) {
            $this->profileForm->setData($request->getPost());

            if ($this->profileForm->isValid()) {
                try {
                    $this->userService->saveInfoUser($user);

                    return $this->redirect()->toRoute('user/profile',array('action' => 'profile','id'=> $user->getId_user()));

                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->profileForm
        ));
    }*/




}


