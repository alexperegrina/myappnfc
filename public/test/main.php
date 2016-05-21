<?php
/**
* Created by PhpStorm.
 * User: alex
 * Date: 21/5/16
 * Time: 18:10
 */

include_once('htpasswd.php');
////$htpasswd = new htpasswd('/var/www/adminarea/.htpasswd'); // path to your .htpasswd file
$htpasswd = new htpasswd('.htpasswd'); // path to your .htpasswd file
//
//// A list of random user names
//$users = array('admin','innvo','santa');
//// Checking to see which users exist
//foreach($users as $user)
//    echo "The username $user does ".($htpasswd->user_exists($user) ? 'exist' : 'not exist')."\n";
//
//// Trying to add all usernames with password 'apples'
//foreach($users as $user)
//    echo "The username $user ".($htpasswd->user_add($user,'apples') ? 'has been added' : 'already exists')."\n";
//
//// Trying to remove user 'santa'
//echo "Removing user 'santa' if present\n";
//$htpasswd->user_delete('santa');
//// Trying to update user innvo with new password 'oranges', will add user if they do not exist
//if($htpasswd->user_update('innvo','oranges'))
//    echo "Updated password for 'innvo'\n";


if($htpasswd->user_exists($user)) {
    $htpasswd->user_add('alex','alex');
}
else {
    $htpasswd->user_update('alex','alex');
}
