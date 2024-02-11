<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Mój Profil</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-container {
            text-align: center;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f5f5f5;
        }

        
    </style>
</head>
<body>
    <a href="user.php" class="link-title"><h1>LibaryManagmentSystem</h1></a>
    <h1>Mój Profil</h1>
    <div class="profile-container">
        <?php
        session_start();
        include 'config.php';

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header("location: login.html");
            exit;
        }

        $uzytkownikID = $_SESSION['UzytkownikID'];

        $sql = "SELECT Imie, Nazwisko, Numer_telefonu, Login FROM Uzytkownicy WHERE UzytkownikID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $uzytkownikID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                echo "<p><strong>Imię:</strong> " . htmlspecialchars($user['Imie']) . "</p>";
                echo "<p><strong>Nazwisko:</strong> " . htmlspecialchars($user['Nazwisko']) . "</p>";
                echo "<p><strong>Numer telefonu:</strong> " . htmlspecialchars($user['Numer_telefonu']) . "</p>";
                echo "<p><strong>Login:</strong> " . htmlspecialchars($user['Login']) . "</p>";
            } else {
                echo "<p>Brak danych o profilu.</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
        }
        ?>
    </div>
</body>
</html>
