<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 16:07
 */

namespace Servicio\Model;


interface ServicioInterface
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
}