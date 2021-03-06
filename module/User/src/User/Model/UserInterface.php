<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 23:56
 */

namespace User\Model;


interface UserInterface
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
     * @return mixed
     */
    public function getId_user();
    /**
     * @return string
     */
    public function getNombre();

    /**
     * @return string
     */
    public function getApellidos();

    /**
     * @return int
     */
    public function getFecha_nacimiento();

    /**
     * @return string
     */
    public function getTipo();
}