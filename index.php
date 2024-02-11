<?php
session_start();

$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $loggedIn ? $_SESSION['username'] : 'Gość';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Biblioteka</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>System Zarządzania Biblioteką</h1>
        <nav>
            <ul>
                <?php if ($loggedIn): ?>
                    <li>Witaj, <?php echo htmlspecialchars($username); ?>!</li>
                    <li><a href="user.php">Mój profil</a></li>
                    <li><a href="logout.php">Wyloguj</a></li>
                <?php else: ?>
                    <li><a href="login.html">Zaloguj się</a></li>
                    <li><a href="register.html">Zarejestruj się</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </header>
    <h3><?php if (!isset($_COOKIE['cookies_accepted'])) {echo '<div>Ta strona używa ciasteczek. <a href="accept_cookies.php">Akceptuję</a></div>';}?></h3>
    
    <footer>
        <p>&copy; Michał Kwaśniewski LibaryManagmentSystem</p>
    </footer>
</body>
</html>
