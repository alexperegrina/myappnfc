<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:43
 */

namespace Comercializador\Service;


use Comercializador\Mapper\ComercializadorMapperInterface;

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

    }

    /**
     * {@inheritDoc}
     */
    public function saveComercializador(ComercializadorInterface $comercializador) {

    }

    /**
     * {@inheritDoc}
     */
    public function deleteComercializador(ComercializadorInterface $comercializador) {

    }
}