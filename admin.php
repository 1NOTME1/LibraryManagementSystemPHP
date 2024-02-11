<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['Rola'] !== 'Admin') {
    header("location: login.php");
    exit;
}

$imieUzytkownika = $_SESSION['username'];

if (!isset($_COOKIE['cookies_accepted'])) {
    echo '<div class="cookies-info">Ta strona używa ciasteczek. <a href="accept_cookiess.php">Akceptuję</a></div>';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administracyjny</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Panel Administracyjny</h1>
       <h1> <?php echo "Witaj ". htmlspecialchars($imieUzytkownika);?> </h1>
        <nav>
            <ul>
                <li><a href="manage_books.php">Zarządzaj Książkami</a></li>
                <li><a href="manage_rentals.php">Zarządzaj Wypożyczeniami</a></li>
                <li><a href="manage_users.php">Zarządzaj Użytkownikami</a></li>
                <li><a href="logout.php">Wyloguj</a></li>
            </ul>
        </nav>
    </header>
    
    <footer>
        <p>&copy; Michał Kwaśniewski LibaryManagmentSystem</p>
    </footer>
</body>
</html>
