<?php

   include 'components/connect.php';

   setcookie('doc_id', '', time() - 1, '/');

   header('location:index.php');

?>