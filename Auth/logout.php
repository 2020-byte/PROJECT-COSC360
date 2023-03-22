

<?php
// start the session
session_start();

// destroy the session
session_destroy();

// redirect to another page
if (!headers_sent()) {
  header("Location: ../page/login.php");
  exit;
} else {
  echo "Error: Headers already sent";
}
?>