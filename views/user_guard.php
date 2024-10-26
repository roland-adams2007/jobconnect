<?php
  if(!isset($_SESSION['user_details']['user_id'])){
      header('location:/jobconnect/');
      exit;
  }
?>