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
}