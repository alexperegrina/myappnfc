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
use Utils\Model\Htpasswd;

class ServicioService implements ServicioServiceInterface
{
    protected $pathHtpaswd;
    /**
     * @var \Servicio\Mapper\ServicioMapperInterface
     */
    protected $servicioMapper;

    /**
     * @var Htpasswd
     */
    protected $htpasswd;

    /**
     * @param ServicioMapperInterface $servicioMapper
     */
    public function __construct(ServicioMapperInterface $servicioMapper)
    {
        $this->pathHtpaswd = getcwd()."/data/module/htpasswd_service";
        $this->servicioMapper = $servicioMapper;
        $this->htpasswd = new Htpasswd($this->pathHtpaswd);
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
    public function saveServicio(ServicioInterface $servicio)
    {

        $servicio = $this->servicioMapper->save($servicio);

        if($this->htpasswd->user_exists($servicio->getUsername())) {
            $this->htpasswd->user_update($servicio->getUsername(), $servicio->getPassword());
        }
        else {
            $this->htpasswd->user_add($servicio->getUsername(), $servicio->getPassword());
        }

        return $servicio;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteServicio(ServicioInterface $servicio) {
        if($this->htpasswd->user_exists($servicio->getUsername())) {
            $this->htpasswd->user_delete($servicio->getUsername());
        }
        return $this->servicioMapper->delete($servicio);
    }

    /**
     * {@inheritDoc}
     */
    public function findServiceByUsername($username) {
        return $this->servicioMapper->findByUsername($username);
    }

    /**
     * {@inheritDoc}
     */
    public function findAllServicesByUsername($username) 
    {
        $servicesResult = array();

        $allServices = $this->servicioMapper->findAll();
        foreach ($allServices as $service) {
            $servicesResult[$service->getId()] = array(
                'username' => $service->getUsername(),
                'nombre' => $service->getNombre(),
                'activado' => false,
            );
        }

        $servicesUser = $this->servicioMapper->findServicesByUsername($username);
        foreach ($servicesUser as $service) {
            $servicesResult[$service->getId()]['activado'] = true;
        }

        $services = array();
        foreach ($servicesResult AS $serv) {
            $services[] = $serv;
        }

        return $services;
    }

    /**
     * {@inheritDoc}
     */
    public function usernameValid($username) {
        $row = $this->servicioMapper->getRowByUsername($username);
        return count($row) == 0 ? true : false;
    }
}