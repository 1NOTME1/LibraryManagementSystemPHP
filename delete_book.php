<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];

    $sql = "DELETE FROM wypozyczenia WHERE KsiazkaID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $book_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "DELETE FROM Ksiazki WHERE KsiazkaID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $book_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo "Książka oraz powiązane z nią wypożyczenia zostały usunięte.";
            header("Location: manage_books.php");
        } else {
            echo "Błąd usuwania książki: " . mysqli_error($conn);
        }
    } else {
        echo "Błąd usuwania powiązanych wypożyczeń: " . mysqli_error($conn);
    }
}
?>
