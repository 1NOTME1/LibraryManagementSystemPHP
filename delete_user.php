<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uzytkownikID = $_POST['uzytkownikID'];

    $sql = "DELETE FROM Uzytkownicy WHERE UzytkownikID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $uzytkownikID);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            echo "Użytkownik został pomyślnie usunięty.";
            header("Location: manage_users.php");
        } else {
            echo "Błąd podczas usuwania użytkownika: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
    }
}
?>
