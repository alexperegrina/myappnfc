<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:15
 */

namespace LoginAlex\Controller;

use LoginAlex\Service\LoginServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Form\FormInterface;



class LoginController extends AbstractActionController
{
    protected $loginForm; //$form
    protected $loginStorage; //$storage
    protected $authservice; // $authservice

//    /**
//     * @var \LoginAlex\Service\LoginServiceInterface
//     */
//    protected $loginService;
//
//    public function __construct(
//        LoginServiceInterface $loginService,
//        FormInterface $loginForm
//    )
//    {
//        $this->loginService = $loginService;
//        $this->loginForm = $loginForm;
//    }
    
    public function loginAction() {


//        $user = $this->loginService->findUser("alex");
//
//
//        $a = new ViewModel(array(
//            'user' => "a"
//        ));
        
        //print_r($a);die();

//        return new ViewModel(array(
//            'user' => "a"
//        ));
    }
    

}