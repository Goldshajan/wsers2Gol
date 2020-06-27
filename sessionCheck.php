<?php
session_start();
if (!isset($_SESSION["UserLogged"])) {
  $_SESSION["UserLogged"] = false;
}
if(!isset($_SESSION["Basket"])){
  $_SESSION["Basket"]=[];
}
?>
