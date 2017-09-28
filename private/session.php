<?php
ob_start(); //turn on output buffering

session_start(); //start the session

//Variable to determine if the Hit and Stay buttons should be visible upon rendering the page
//If the dealer and/or player has BlackJack, and buttons will be disabled.
$showButton = "";
$_SESSION["showButton"] = $showButton;
?>