<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13/4/16
 * Time: 21:47
 */

namespace Login\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Factory;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);

        // $this->setInputFilter(new \Modulo\Form\AddUsuarioValidator());

        $this->setAttributes(array(
            //'action' => $this->url.'/modulo/recibirformulario',
            'action'=>"",
            'method' => 'post'
        ));

        $this->add(array(
            'name' => 'mail',
            'attributes' => array(
                'type' => 'mail',
                'class' => 'input form-control',
                'required'=>'required'
            )
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'class' => 'input form-control',
                'required'=>'required'
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Entrar',
                'title' => 'Entrar',
                'class' => 'btn btn-success'
            ),
        ));

    }
}