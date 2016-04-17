<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:24
 */

namespace LoginAlex\Model;


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
     * @return string
     */
    public function getTipo();
}