<?php
    setcookie('cookies_accepted', '1', time() + (3600), "/"); 
    header("Location: index.php"); 
    exit;
?>
