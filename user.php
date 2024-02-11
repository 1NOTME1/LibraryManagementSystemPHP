<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$imieUzytkownika = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Twój Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Witaj <?php echo htmlspecialchars($imieUzytkownika); ?></h1>
        <nav>
            <ul>
                <li><a href="my_profile.php">Mój Profil</a></li>
                <li><a href="my_loans.php">Moje Wypożyczenia</a></li>
                <li><a href="logout.php">Wyloguj</a></li>

            </ul>
        </nav>
    </header>
    <footer>
        <p>&copy; Michał Kwaśniewski LibaryManagmentSystem</p>
    </footer>
</body>
</html>
