<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loan_id'])) {
    $wypozyczenieID = $_POST['loan_id'];
    $dataZwrotu = date("Y-m-d H:i:s");

    mysqli_begin_transaction($conn);

    try {
        $sqlReturn = "UPDATE Wypozyczenia SET Data_zwrotu = ? WHERE WypozyczenieID = ? AND Data_zwrotu IS NULL";
        if ($stmtReturn = mysqli_prepare($conn, $sqlReturn)) {
            mysqli_stmt_bind_param($stmtReturn, "si", $dataZwrotu, $wypozyczenieID);
            mysqli_stmt_execute($stmtReturn);
            mysqli_stmt_close($stmtReturn);
        }

        $sqlFindBookID = "SELECT KsiazkaID FROM Wypozyczenia WHERE WypozyczenieID = ?";
        if ($stmtFindBookID = mysqli_prepare($conn, $sqlFindBookID)) {
            mysqli_stmt_bind_param($stmtFindBookID, "i", $wypozyczenieID);
            mysqli_stmt_execute($stmtFindBookID);
            $resultFindBookID = mysqli_stmt_get_result($stmtFindBookID);
            if ($bookIDData = mysqli_fetch_assoc($resultFindBookID)) {
                $ksiazkaID = $bookIDData['KsiazkaID'];
                
                $sqlUpdateBook = "UPDATE Ksiazki SET Stan = 'Dostępna' WHERE KsiazkaID = ?";
                if ($stmtUpdateBook = mysqli_prepare($conn, $sqlUpdateBook)) {
                    mysqli_stmt_bind_param($stmtUpdateBook, "i", $ksiazkaID);
                    mysqli_stmt_execute($stmtUpdateBook);
                    mysqli_stmt_close($stmtUpdateBook);
                }
            }
            mysqli_stmt_close($stmtFindBookID);
        }

        mysqli_commit($conn);

        $_SESSION['message'] = "Książka została zwrócona.";
    } catch (mysqli_sql_exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "Błąd podczas zwracania książki: " . $e->getMessage();
    }

    mysqli_close($conn);
    header("Location: manage_rentals.php");
    exit;
} else {
    header("Location: manage_rentals.php");
    exit;
}
?>
