<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 23/5/16
 * Time: 0:41
 */

namespace Authenticate\Model;


class Session
{

    protected $id;

    protected $username;

    protected $ip;

    protected $user_agent;

    /**
     * Session constructor.
     * @param $id
     * @param $username
     * @param $user_agent
     * @param $ip
     */
    public function __construct($id, $username, $user_agent, $ip)
    {
        $this->id = $id;
        $this->username = $username;
        $this->user_agent = $user_agent;
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->user_agent;
    }

    /**
     * @param mixed $user_agent
     */
    public function setUserAgent($user_agent)
    {
        $this->user_agent = $user_agent;
    }
}