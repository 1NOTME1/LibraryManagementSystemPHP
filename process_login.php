<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['login'];
    $password = md5($_POST['password']);

    $sql = "SELECT UzytkownikID, Rola FROM Uzytkownicy WHERE Login = ? AND Haslo = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['loggedin'] = true;
            $_SESSION['UzytkownikID'] = $user['UzytkownikID'];
            $_SESSION['Rola'] = $user['Rola'];
        
            $_SESSION['username'] = $username;
        
            if ($user['Rola'] == 'Admin') {
                header("location: admin.php");
            } else {
                header("location: user.php");
            }
        } else {
            echo "Nieprawidłowy login lub hasło.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
    }
} else {
    header("location: login.html");
}
?>
