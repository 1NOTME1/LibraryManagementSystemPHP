<?php
session_start();
session_unset();
session_destroy();

if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", "", time() - 3600, '/');
}

file_put_contents('logout_log.txt', "Wylogowanie: " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);

header("Location: index.php");
exit;
?>
