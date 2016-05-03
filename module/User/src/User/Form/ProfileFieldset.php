<?php
/**
 * Created by PhpStorm.
 * User: irinavasilieva
 * Date: 26/04/16
 * Time: 01:26
 */

namespace User\Form;

use User\Model\User;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProfileFieldset extends Fieldset
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new User());

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id_user',
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'nombre',
            'options' => array(
                'label' => 'Name'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'apellidos',
            'options' => array(
                'label' => 'Surname'
            )
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'fecha_nacimiento',
            'options' => array(
                'label' => 'Date of Birth'
            )
        ));
    }
}