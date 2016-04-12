<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 17:37
 */

namespace Servicio\Service;

use Servicio\Model\ServicioInterface;
use Servicio\Mapper\ServicioMapperInterface;

class ServicioService implements ServicioServiceInterface
{
    /**
     * @var \Servicio\Mapper\ServicioMapperInterface
     */
    protected $servicioMapper;

    /**
     * @param ServicioMapperInterface $servicioMapper
     */
    public function __construct(ServicioMapperInterface $servicioMapper)
    {
        
        $this->servicioMapper = $servicioMapper;

    }

    /**
     * {@inheritDoc}
     */
    public function findAllServicio() {
        return $this->servicioMapper->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findServicio($id) {
        return $this->servicioMapper->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function saveServicio(ServicioInterface $servicio) {
        return $this->servicioMapper->save($servicio);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteServicio(ServicioInterface $servicio) {
        return $this->servicioMapper->delete($servicio);
    }
}