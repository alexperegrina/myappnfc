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

    public function __construct(UserServiceInterface $userService, FormInterface $profileForm)
    {
        $this->userService = $userService;
        $this->profileForm    = $profileForm;
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
        
        return new ViewModel(array(
            'user' => $user
        ));
    }

    public function editAction()
    {
        $request = $this->getRequest();
        $user    = $this->userService->findUser($this->params('id'));

        $this->profileForm->bind($user);

        if ($request->isPost()) {
            $this->profileForm->setData($request->getPost());

            if ($this->profileForm->isValid()) {
                try {
                    $this->userService->saveInfoUser($user);
                    //\Zend\Debug\Debug::dump($user);die();

                    return $this->redirect()->toRoute('user/profile',array('action' => 'profile','id'=> $user->getId()));
                    
                } catch (\Exception $e) {
                    die($e->getMessage());
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->profileForm
        ));
    }

}