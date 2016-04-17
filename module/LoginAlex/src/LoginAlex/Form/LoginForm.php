<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15/4/16
 * Time: 0:04
 */

namespace LoginAlex\Form;

use Zend\Form\Form;

class LoginForm extends Form
{

    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

//        $this->add(array(
//            'name' => 'post-fieldset',
//            'type' => 'Servicio\Form\ServicioFieldset',
//            'options' => array(
//                'use_as_base_fieldset' => true
//            )
//        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Insert new Servicio'
            )
        ));
    }
}