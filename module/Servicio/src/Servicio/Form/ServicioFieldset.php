<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 20:40
 */

namespace Servicio\Form;

use Servicio\Model\Servicio;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class ServicioFieldset extends Fieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Servicio());

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'username',
            'options' => array(
                'label' => 'Username'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'password',
            'options' => array(
                'label' => 'Password'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'mail',
            'options' => array(
                'label' => 'Mail'
            )
        ));
    }
}