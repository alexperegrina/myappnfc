<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 20:43
 */

namespace Servicio\Form;

use Zend\Form\Form;

class ServicioForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'post-fieldset',
            'type' => 'Servicio\Form\ServicioFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Insert new Servicio'
            )
        ));
    }
}