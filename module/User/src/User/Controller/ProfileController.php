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

    protected $profileForm;

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

        //\Zend\Debug\Debug::dump($request);die();
        if ($request->isPost()) {

            $tag = $request->getPost('tag', 'Add');

            $this->userService->addItem($this->params('id'), $tag);

            //return $this->redirect()->toRoute('user/profile/'.$this->params('id'));
        }

        return new ViewModel(array(
            'user' => $user,
            'profile' => $this->userService->getUserProfile($this->params('id')),
            'companies' => $this->userService->listUserCompanies($this->params('id')),
            'services' => $this->userService->listUserServices($this->params('id')),
            'info_service' => $this->userService->listUserInfoServices($this->params('id')),
            'tags' => $this->userService->listUserTags($this->params('id'))
        ));
    }
    
}