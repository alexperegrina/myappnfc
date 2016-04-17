<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 16:16
 */

namespace LoginAlex\Mapper;

use LoginAlex\Model\UserInterface;

interface LoginMapperInterface
{

    /**
     * @param string $username
     * @return UserInterface
     * @throws \InvalidArgumentException
     */
    public function findByUsername($username);
    
//    /**
//     * @param int|string $id
//     * @return UserInterface
//     * @throws \InvalidArgumentException
//     */
//    public function find($id);
//
//    /**
//     * @return array|ServicioInterface[]
//     */
//    public function findAll();
//
//    /**
//     * @param ServicioInterface $servicioObject
//     *
//     * @param ServicioInterface $servicioObject
//     * @return ServicioInterface
//     * @throws \Exception
//     */
//    public function save(ServicioInterface $servicioObject);
//
//    /**
//     * @param ServicioInterface $servicioObject
//     *
//     * @return bool
//     * @throws \Exception
//     */
//    public function delete(ServicioInterface $servicioObject);
}