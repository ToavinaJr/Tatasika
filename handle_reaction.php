<?php
require_once "config.php";
require_once "verify_session.php";

if (isset($_GET['type'])) {
    echo $_GET['type'];
}