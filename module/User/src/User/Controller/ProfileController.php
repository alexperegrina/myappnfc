<?php
/**
 * Created by PhpStorm.
 * User: irinavasilieva
 * Date: 23/04/16
 * Time: 12:49
 */
namespace User\Controller;

use Servicio\Model\Servicio;
use User\Service\UserServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProfileController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    //protected $profileForm;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function profileAction()
    {
        try {
            $user = $this->userService->findUser($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('user');
        }

        $request = $this->getRequest();

        if ($request->isPost()) {
            if (!is_null($request->getPost('tag'))) $this->userService->addItem($user->getId(), $request->getPost());
            if (!is_null($request->getPost('cambiar_estado'))) {
                if ($request->getPost() == "Active") $this->userService->changeServiceStatus($user->getUsername(), $this->params('id_servicio'));
                else $this->userService->changeServiceStatus($user->getUsername(), $this->params('id_servicio'));
            }
        }

        return new ViewModel(array(
            'user' => $user,
            'profile' => $this->userService->getUserProfile($user->getId()),
            'companies' => $this->userService->listUserCompanies($user->getId()),
            'services' => $this->userService->listUserServices($user->getId()),
            'info_service' => $this->userService->listUserInfoServices($user->getId()),
            'tags' => $this->userService->listUserTags($user->getId())
        ));
    }
    
}