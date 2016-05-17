<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 16:10
 */

namespace Servicio\Service;

use Servicio\Model\ServicioInterface;

interface ServicioServiceInterface
{

    /**
     * Devuelve un conjunto de Servicios. se supone que son \Servicio\Model\ServicioInterface
     *
     * @return array|ServicioInterface[]
     */
    public function findAllServicio();

    /**
     * Devulve un unico Servicio
     *
     * @param  int $id Identificador del Servicio a devolver
     * @return ServicioInterface
     */
    public function findServicio($id);

    /**
     * Guarda un Servicio
     *
     * @param  ServicioInterface $servicio
     * @return ServicioInterface
     */
    public function saveServicio(ServicioInterface $servicio);

    /**
     * Elimina un Servicio y si no devuelve false.
     *
     * @param  ServicioInterface $servicio
     * @return bool
     */
    public function deleteServicio(ServicioInterface $servicio);
    
    public function findServiceByUsernameId($id);
}