<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:18
 */

namespace User\Controller;

use User\Service\UserServiceInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Authenticate\Service\AuthServiceInterface;

class WriteController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    protected $userForm;

    protected $authService;

    public function __construct(
        UserServiceInterface $userService,
        FormInterface $userForm,
        AuthServiceInterface $authService
    ) {
        $this->userService = $userService;
        $this->userForm    = $userForm;
        $this->authService = $authService;
    }

    public function addAction()
    {
        $this->redirectUserNormal(-1);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $this->userForm->setData($request->getPost());

            if ($this->userForm->isValid()) {
                try {

                    $this->userService->saveUser($this->userForm->getData());

                    return $this->redirect()->toRoute('user');
                } catch (\Exception $e) {
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->userForm
        ));
    }

    public function editAction()
    {
        $this->redirectUserNormal($this->params('id'));

        $request = $this->getRequest();
        $user    = $this->userService->findUser($this->params('id'));

        $this->userForm->bind($user);

        if ($request->isPost()) {
            $this->userForm->setData($request->getPost());

            if ($this->userForm->isValid()) {
                try {
                    $this->userService->saveUser($user);
                    return $this->redirect()->toRoute('user');
                } catch (\Exception $e) {
                    die($e->getMessage());
                    // Some DB Error happened, log it and let the user know
                }
            }
        }

        return new ViewModel(array(
            'form' => $this->userForm
        ));
    }

    public function signinAction() {
        $error = "";

        $request = $this->getRequest();

        if ($request->isPost()) {

            $this->userForm->setData($request->getPost());

            if ($this->userForm->isValid()) {
                //comprovamos que ya exista un usuario con este username

                if(!$this->userService->usernameValid(
                    $this->userForm->getData()->getUsername())) {
//                    die("dentro de error");
                    $error = "El username ya es utilizado";

                }
                else {
                    try {

//                        //encriptamos el password
//                        $passwordOld = $this->userForm->getData()->getPassword();
//                        $passwordNew = md5($passwordOld);
//                        $this->userForm->getData()->setPassword($passwordNew);

                        $this->userService->saveUser($this->userForm->getData());

                        return $this->redirect()->toRoute('authenticate');
                    } catch (\Exception $e) {
                        // Some DB Error happened, log it and let the user know
                        die($e->getMessage());
                    }
                }
            }
        }

        $this->userForm->get('submit')->setValue('Sign In');

        return new ViewModel(array(
            'form' => $this->userForm,
            'error' => $error
        ));
    }

    private function redirectUserNormal($id) {

        if (!$this->authService->logged()) {
            return $this->redirect()->toRoute('authenticate');
        }

        $session = $this->authService->getSession();
        $user = $this->userService->findUserByUsername($session->getUsername());

        if($user->getTipo() != 'admin' && $id != $user->getId()) {
            $this->authService->redireccionByType($this, $user->getId(), $user->getTipo());
        }
    }
}