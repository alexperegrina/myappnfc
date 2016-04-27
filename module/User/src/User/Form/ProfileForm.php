<?php
/**
 * Created by PhpStorm.
 * User: irinavasilieva
 * Date: 26/04/16
 * Time: 01:29
 */

namespace User\Form;

use Zend\Form\Form;

class ProfileForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);

        $this->add(array(
            'name' => 'post-fieldset',
            'type' => 'User\Form\ProfileFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Edit profile'
            )
        ));
    }
}