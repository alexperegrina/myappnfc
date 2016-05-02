<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17/4/16
 * Time: 18:47
 */

namespace Authenticate\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;

class SuccessController extends AbstractActionController
{
    public function indexAction()
    {
        //here for test only, you should check session
        //for real application
    }
}