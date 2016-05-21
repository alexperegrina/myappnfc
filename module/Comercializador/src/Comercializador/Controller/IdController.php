<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15/5/16
 * Time: 17:32
 */

namespace Comercializador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Comercializador\Service\ComercializadorServiceInterface;


class IdController  extends AbstractActionController
{

    /**
     * @var \Comercializador\Service\ComercializadorServiceInterface
     */
    protected $comercializadorService;


    public function __construct(ComercializadorServiceInterface $comercializadorService)
    {
        $this->comercializadorService = $comercializadorService;
    }

    public function solicitarAction()
    {

        try {
            $comercializador = $this->comercializadorService->findComercializador($this->params('id'));
        } catch (\InvalidArgumentException $e) {
            return $this->redirect()->toRoute('comercializador');
        }

        $this->comercializadorService->solicitarIds($comercializador, 100);
        
        return $this->redirect()->toRoute('comercializador/profile',array('action' => 'profile','id'=> $comercializador->getId()));
    }
}