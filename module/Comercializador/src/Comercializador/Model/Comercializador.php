<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/4/16
 * Time: 23:56
 */

namespace Comercializador\Model;


class Comercializador implements ComercializadorInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $mail;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $descripcion;

    
    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * {@inheritDoc}
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * {@inheritDoc}
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * {@inheritDoc}
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre) 
    {
        $this->nombre = $nombre;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;    
    }

}