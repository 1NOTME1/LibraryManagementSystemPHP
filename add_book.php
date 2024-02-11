<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tytul = $_POST['title'];
    $autor = $_POST['author'];
    $rok_wydania = $_POST['year'];

    $sql = "INSERT INTO Ksiazki (Tytul, Autor, Rok_wydania, Stan) VALUES (?, ?, ?, 'Dostępna')";
    
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sss', $tytul, $autor, $rok_wydania);
        $result = mysqli_stmt_execute($stmt);
        if ($result) {
            echo "Książka została pomyślnie dodana.";
            header("Location: manage_books.php");
        } else {
            echo "Błąd podczas dodawania książki: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
    }
} else {
    header("location: manage_books.html");
}
?>
