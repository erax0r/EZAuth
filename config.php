<?php

/********************************
EZauth v.1
Author: Andrew Goetz
File: Configuration
*********************************/

/********************************
Password Encryption Level 
Options are:
md5,sha256,sha512
*********************************/
$ezencryption = 'sha512';

/********************************
MySQL Credentials
*********************************/
$ezdbdatabase = "db";
$ezdbserver = "localhost";
$ezdbusername = "user";
$ezdbpassword = "pass";
$ezdbtable = "users";

/********************************
Debugging Options
Set $ezdebug = 1 for debugging
*********************************/
$ezdebug = 0;

?>