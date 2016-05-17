<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 11/4/16
 * Time: 0:00
 */

namespace Comercializador\Mapper;

use Comercializador\Model\ComercializadorInterface;

interface ComercializadorMapperInterface
{

    /**
     * @param int|string $id
     * @return ComercializadorInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @return array|ComercializadorInterface[]
     */
    public function findAll();

    /**
     * @param ComercializadorInterface $comercializadorObject
     *
     * @param ComercializadorInterface $comercializadorObject
     * @return ComercializadorInterface
     * @throws \Exception
     */
    public function save(ComercializadorInterface $comercializadorObject);

    /**
     * @param ComercializadorInterface $comercializadorObject
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(ComercializadorInterface $comercializadorObject);

    /**
     * Metodo para consultar si los id estan el la BD
     *
     * @param string[] $ids
     * @return ResultSet, devuelve los id que son repetidos
     */
    public function validIds($ids);
    
    /**
     *  Metodo para guardar un conjunto de ids a un comercializador
     * 
     * @param ComercializadorInterface $comercializadorObject
     * @param int[] $ids
     * @return mixed
     */
    public function saveIds(ComercializadorInterface $comercializadorObject, $ids);

    /**
     * Metodo para consultar los ids que tiene un comercializador
     *
     * @param ComercializadorInterface $comercializadorObject
     * @return ResultSet
     */
    public function getIdsByComercializador(ComercializadorInterface $comercializadorObject);

    /**
     * Metodo para cojer un usuario con un cierto username
     *
     * @param $username
     * @return array
     */
    public function getRowByUsername($username) ;
}