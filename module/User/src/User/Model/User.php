<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/4/16
 * Time: 23:56
 */

namespace User\Model;

class User implements UserInterface
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
    protected $apellidos;

    /**
     * @var int
     */
    protected $fecha_nacimiento;

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
     * @return string
     */
    public function getName()
    {
        return $this->nombre;
    }

    /**
     * @param string
     */
    public function setName($name)
    {
        $this->nombre = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->apellidos;
    }

    /**
     * @param string
     */
    public function setSurname($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return int
     */
    public function getBirthDate()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * @param int
     */
    public function setBirthDate($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }
}