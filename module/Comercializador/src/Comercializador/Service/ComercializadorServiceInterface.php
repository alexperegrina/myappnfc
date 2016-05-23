<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:44
 */

namespace Comercializador\Service;

use Comercializador\Model\ComercializadorInterface;

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
     * @param  ComercializadorInterface $comercializador
     * @return bool
     */
    public function deleteComercializador(ComercializadorInterface $comercializador);
    
    /**
     *  Metodo para crear y asignar un cierto numero de identificadors a un comercializador
     * 
     * @param ComercializadorInterface $comercializador
     * @param int $cantidad
     * @return mixed
     */
    public function solicitarIds(ComercializadorInterface $comercializador, $cantidad);

    /**
     * Metodo para consultar los ids asignados a un comercializador
     *
     * @param ComercializadorInterface $comercializador
     * @return string[]
     */
    public function findIdsComercializador(ComercializadorInterface $comercializador);

    /**
     * Metodo para validar si un username ya esta siendo utilizado
     *
     * @param $username
     * @return bool
     */
    public function usernameValid($username);
}