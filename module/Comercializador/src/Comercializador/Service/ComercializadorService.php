<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:43
 */

namespace Comercializador\Service;


use Comercializador\Mapper\ComercializadorMapperInterface;
use Comercializador\Model\ComercializadorInterface;
use Rhumsaa\Uuid\Uuid;
use Zend\Db\ResultSet\ResultSet;

class ComercializadorService implements ComercializadorServiceInterface
{


    /**
     * @var \Comercializador\Mapper\ComercializadorMapperInterface
     */
    protected $comercializadorMapper;

    /**
     * @param PostMapperInterface $postMapper
     */
    public function __construct(ComercializadorMapperInterface $comercializadorMapper)
    {
        $this->comercializadorMapper = $comercializadorMapper;

    }

    /**
     * {@inheritDoc}
     */
    public function findAllComercializador() {
        return $this->comercializadorMapper->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findComercializador($id) {
        return $this->comercializadorMapper->find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function saveComercializador(ComercializadorInterface $comercializador) {
        return $this->comercializadorMapper->save($comercializador);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteComercializador(ComercializadorInterface $comercializador) {
        return $this->comercializadorMapper->delete($comercializador);
    }

    /**
     * {@inheritDoc}
     */
    public function solicitarIds(ComercializadorInterface $comercializador, $cantidad)
    {
        $ids = array();
        for($i = 0; $i < $cantidad; $i++) {
            $prefix = microtime() + $comercializador->getUsername() + $i;
            $id = Uuid::uuid5(Uuid::NAMESPACE_DNS, $prefix)->toString();
            $ids[] = $id;
        }

        do {
            /**
             * @var ResultSet
             */
            $result = $this->comercializadorMapper->validIds($ids);
        } while($result->count() != 0);

        /**
         * @var ResultSet
         */
        $result = $this->comercializadorMapper->saveIds($comercializador, $ids);
        
    }

    /**
     * {@inheritDoc}
     */
    public function findIdsComercializador(ComercializadorInterface $comercializador) 
    {
        return $this->comercializadorMapper->getIdsByComercializador($comercializador);
    }

    /**
     * {@inheritDoc}
     */
    public function usernamevalid($username) {

        $row = $this->comercializadorMapper->getRowByUsername($username);
//        print_r(count(count($row) == 0 ? true : false));die();
        return count($row) == 0 ? true : false;
    }
}