<?php
include_once 'init.php';

Session::unsetSession("uid");
Session::unsetSession("isLoggedIn");

header("Location: login.php");