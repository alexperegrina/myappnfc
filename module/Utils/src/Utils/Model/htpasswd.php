<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21/5/16
 * Time: 18:32
 */

namespace Utils\Model;


class Htpasswd
{
    var $fp;
    var $filename;


    public function __construct($filename) {
//        @$this->fp = fopen($filename,'r+') or die('Invalid file name');
//        print_r("aaa");die($filename);
        $this->fp = fopen($filename,'r+') or die('Invalid file name');
        $this->filename = $filename;
    }

//    function Htpasswd($filename) {
////        @$this->fp = fopen($filename,'r+') or die('Invalid file name');
//        die($filename);
//        $this->fp = fopen($filename,'r+') or die('Invalid file name');
//        $this->filename = $filename;
//    }



    function user_exists($username) {
        rewind($this->fp);
        while(!feof($this->fp) && trim($lusername = array_shift(explode(":",$line = rtrim(fgets($this->fp)))))) {
            if($lusername == $username)
                return 1;
        }
        return 0;
    }

    function user_add($username,$password) {
        if($this->user_exists($username))
            return false;
        fseek($this->fp,0,SEEK_END);
        fwrite($this->fp,$username.':'.crypt($password,substr(str_replace('+','.',base64_encode(pack('N4', mt_rand(),mt_rand(),mt_rand(),mt_rand()))),0,22))."\n");
        return true;
    }

    function user_delete($username) {
        $data = '';
        rewind($this->fp);
        while(!feof($this->fp) && trim($lusername = array_shift(explode(":",$line = rtrim(fgets($this->fp)))))) {
            if(!trim($line))
                break;
            if($lusername != $username)
                $data .= $line."\n";
        }
        $this->fp = fopen($this->filename,'w');
        fwrite($this->fp,rtrim($data).(trim($data) ? "\n" : ''));
        fclose($this->fp);
        $this->fp = fopen($this->filename,'r+');
        return true;
    }

    function user_update($username,$password) {
        rewind($this->fp);
        while(!feof($this->fp) && trim($lusername = array_shift(explode(":",$line = rtrim(fgets($this->fp)))))) {
            if($lusername == $username) {
                fseek($this->fp,(-15 - strlen($username)),SEEK_CUR);
                fwrite($this->fp,$username.':'.crypt($password,substr(str_replace('+','.',base64_encode(pack('N4', mt_rand(),mt_rand(),mt_rand(),mt_rand()))),0,22))."\n");
                return true;
            }
        }
        return false;
    }
}