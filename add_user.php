<?php
    require 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $imie = $_POST['fname'];
        $nazwisko = $_POST['lname'];
        $numerTelefonu = $_POST['phone'];
        $login = $_POST['username'];
        $haslo = md5($_POST['password']);

        $sql = "INSERT INTO Uzytkownicy (Imie, Nazwisko, Numer_telefonu, Login, Haslo, Rola) VALUES (?, ?, ?, ?, ?, 'Uzytkownik')";
        
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt)
        {
            mysqli_stmt_bind_param($stmt, 'sssss', $imie, $nazwisko, $numerTelefonu, $login, $haslo);
            $result = mysqli_stmt_execute($stmt);
            if ($result)
            {
                echo "Użytkownik został pomyślnie dodany.";
            } else
            {
                echo "Błąd podczas dodawania użytkownika: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        }
        else
        {
            echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
        }
    } 
    else
    {
        header("location: manage_users.html");
    }
?>
