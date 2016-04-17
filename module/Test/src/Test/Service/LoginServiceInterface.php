<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14/4/16
 * Time: 23:21
 */

namespace Test\Service;


interface LoginServiceInterface
{

    /**
     * Devulve un unico Servicio
     *
     * @param  string $username Identificador del usuario a devolver
     * @return LoginInterface
     */
    public function findUser($username);
}