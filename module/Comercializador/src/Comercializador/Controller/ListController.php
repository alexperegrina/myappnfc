<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:42
 */

namespace Comercializador\Controller;

use Comercializador\Service\ComercializadorServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ListController extends AbstractActionController
{

    /**
     * @var \Comercializador\Service\ComercializadorServiceInterface
     */
    protected $comercializadorService;

    public function __construct(ComercializadorServiceInterface $comercializadorService)
    {
        $this->comercializadorService = $comercializadorService;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'comercializadores' => $this->comercializadorService->findAllComercializador()
        ));
        
    }
}