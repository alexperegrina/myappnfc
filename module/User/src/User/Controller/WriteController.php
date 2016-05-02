<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 0:18
 */

namespace User\Controller;

use User\Service\UserServiceInterface;
use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WriteController extends AbstractActionController
{
    /**
     * @var \User\Service\UserServiceInterface
     */
    protected $userService;

    protected $userForm;

    public function __construct(
        UserServiceInterface $userService,
        FormInterface $userForm
    ) {
        $this->userService = $userService;
        $this->userForm    = $userForm;
    }

    public function addAction()
    {
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
}