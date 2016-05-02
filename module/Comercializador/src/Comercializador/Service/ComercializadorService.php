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
}