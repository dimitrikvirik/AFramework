<?php
require "rb.php";
$conf =  Util::ReadConf("server");
R::setup( 'mysql:host='.$conf["host"].';dbname='.$conf['dbname'], $conf['user'], $conf['password']);