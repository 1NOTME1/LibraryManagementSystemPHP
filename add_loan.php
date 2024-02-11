<?php
    require 'config.php';
    session_start();

    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
    {
        header("Location: login.html");
        exit;
    }

    $ksiazkaID = '';
    $czytelnikID = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id']))
    {
        $ksiazkaID = $_POST['book_id'];
    } 
    elseif (isset($_GET['book_id']))
    {
        $ksiazkaID = $_GET['book_id'];
    }

    if (!empty($ksiazkaID))
    {
        $czytelnikID = $_SESSION['UzytkownikID'];
        $dataWypozyczenia = date("Y-m-d");

        $sql = "INSERT INTO Wypozyczenia (KsiazkaID, CzytelnikID, Data_wypozyczenia, Data_zwrotu) VALUES (?, ?, ?, NULL)";
        if ($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, 'iis', $ksiazkaID, $czytelnikID, $dataWypozyczenia);
            if (mysqli_stmt_execute($stmt))
            {
                $sqlUpdateBook = "UPDATE Ksiazki SET Stan = 'Wypożyczona' WHERE KsiazkaID = ?";
                if ($stmtUpdateBook = mysqli_prepare($conn, $sqlUpdateBook))
                {
                    mysqli_stmt_bind_param($stmtUpdateBook, 'i', $ksiazkaID);
                    mysqli_stmt_execute($stmtUpdateBook);
                    mysqli_stmt_close($stmtUpdateBook);
                }
            }
            mysqli_stmt_close($stmt);
            header("Location: my_loans.php");
            exit();
        } 
        else
        {
            echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
        }
    } 
        else
    {
        header("Location: my_loans.php");
        exit();
    }
?>
