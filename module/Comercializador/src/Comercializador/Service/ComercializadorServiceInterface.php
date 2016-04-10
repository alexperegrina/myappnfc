<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:44
 */

namespace Comercializador\Service;


interface ComercializadorServiceInterface
{

    /**
     * Devuelve un conjunto de Comercializadores. se supone que son \Comercializacor\Model\ComercializadorInterface
     *
     * @return array|ComercialzadorInterface[]
     */
    public function findAllComercializador();

    /**
     * Devulve un unico comercializador
     *
     * @param  int $id Identificador del comercializador a devolver
     * @return ComercializadorInterface
     */
    public function findComercializador($id);

    /**
     * Guarda un Comercializador
     * 
     * @param  ComercializadorInterface $comercializador
     * @return ComercializadorInterface
     */
    public function saveComercializador(ComercializadorInterface $comercializador);

    /**
     * Elimina un comercializador y si no devuelve false.
     *
     * @param  ComercializadorInterface $blog
     * @return bool
     */
    public function deleteComercializador(ComercializadorInterface $comercializador);
}