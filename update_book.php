<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KsiazkaID = $_POST['KsiazkaID'];
    $tytul = $_POST['title'];
    $autor = $_POST['author'];
    $rok_wydania = $_POST['year'];
    $stan = $_POST['status'];

    $sql = "UPDATE Ksiazki SET Tytul = ?, Autor = ?, Rok_wydania = ?, Stan = ? WHERE KsiazkaID = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssssi', $tytul, $autor, $rok_wydania, $stan, $KsiazkaID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Książka została zaktualizowana.";
        header("Location: manage_books.php");
    } else {
        echo "Błąd aktualizacji książki: " . mysqli_error($conn);
    }
}


?>
