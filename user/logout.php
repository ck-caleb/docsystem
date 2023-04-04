<?php
ini_set("display_errors", 0);
@include 'config.php';

session_start();
session_unset();
session_destroy();

header('location:login_form.php');
