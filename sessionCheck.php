<?php
session_start();
if (!isset($_SESSION["UserLogged"])) {
  $_SESSION["UserLogged"] = false;
}

?>
