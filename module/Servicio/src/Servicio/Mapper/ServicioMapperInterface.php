<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 16:16
 */

namespace Servicio\Mapper;

use Servicio\Model\ServicioInterface;

interface ServicioMapperInterface
{
    /**
     * @param int|string $id
     * @return ServicioInterface
     * @throws \InvalidArgumentException
     */
    public function find($id);

    /**
     * @return array|ServicioInterface[]
     */
    public function findAll();

    /**
     * @param ServicioInterface $servicioObject
     *
     * @param ServicioInterface $servicioObject
     * @return ServicioInterface
     * @throws \Exception
     */
    public function save(ServicioInterface $servicioObject);

    /**
     * @param ServicioInterface $servicioObject
     *
     * @return bool
     * @throws \Exception
     */
    public function delete(ServicioInterface $servicioObject);

    /**
     * Metodo para cojer todos los servicios con el username
     * 
     * @param $id
     * @return mixed
     */
    public function findServicesByUsername($id);
}