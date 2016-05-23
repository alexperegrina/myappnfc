<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:55
 */

namespace Comercializador\Model;


interface ComercializadorInterface
{

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getMail();

    /**
     * @return string
     */
    public function getNombre();

    /**
     * @return string
     */
    public function getDescripcion();
}