<?php
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {
    exit("NOT ALLOWED");
}
define('DIRECT', TRUE);
require_once 'functions.php';
$user = new user;
?>