<?php
  function sanitizer($evilString){
  $safeString = strip_tags($evilString);
  $safeString=addslashes($safeString);
  $safeString=htmlentities($safeString);
  return $safeString;
  }


?>