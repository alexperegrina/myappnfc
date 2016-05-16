<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 18:48
 */

namespace Comercializador\Form;

use Comercializador\Model\Comercializador;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class ComercializadorFieldset extends Fieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Comercializador());

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
            'name' => 'nombre',
            'options' => array(
                'label' => 'Nombre'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'mail',
            'options' => array(
                'label' => 'Mail'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'descripcion',
            'options' => array(
                'label' => 'Descripcion'
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