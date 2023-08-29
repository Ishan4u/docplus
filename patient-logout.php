<?php

   include 'components/connect.php';

   setcookie('p_id', '', time() - 1, '/');

   header('location:index.php');

?>