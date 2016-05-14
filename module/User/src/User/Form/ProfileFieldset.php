<?php
/**
 * Created by PhpStorm.
 * User: irinavasilieva
 * Date: 26/04/16
 * Time: 01:26
 */
/*
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
    }
}