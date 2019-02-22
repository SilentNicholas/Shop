<?php
require "dtabase/db.php";
unset($_SESSION['remb_user']);
header('Location: ./registration.php');
?>