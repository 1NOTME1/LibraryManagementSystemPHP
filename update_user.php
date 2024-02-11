<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['uzytkownikID'])) {
        $uzytkownikID = $_POST['uzytkownikID'];
        $imie = $_POST['fname'];
        $nazwisko = $_POST['lname'];
        $numer_telefonu = $_POST['phone'];
        $login = $_POST['username'];
        $rola = $_POST['role'];

        include 'config.php';

        $hashed_password = null;
        if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
            if ($_POST['password'] == $_POST['confirm_password']) {
                $hashed_password = md5($_POST['password']);
                echo "Hashed password (MD5): " . $hashed_password;
            } else {
                echo "Hasła się nie zgadzają.";
                exit;
            }
        }

        $sql = "UPDATE Uzytkownicy SET Imie = ?, Nazwisko = ?, Numer_telefonu = ?, Login = ?, Rola = ?" 
            . ($hashed_password !== null ? ", Haslo = ?" : "") . " WHERE UzytkownikID = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            if ($hashed_password !== null) {
                mysqli_stmt_bind_param($stmt, "sssssss", $imie, $nazwisko, $numer_telefonu, $login, $rola, $hashed_password, $uzytkownikID);
            } else {
                mysqli_stmt_bind_param($stmt, "sssssi", $imie, $nazwisko, $numer_telefonu, $login, $rola, $uzytkownikID);
            }

            if (mysqli_stmt_execute($stmt)) {
                echo "Rekord użytkownika został zaktualizowany.";
                header("Location: manage_users.php");
                // exit;
            } else {
                echo "Błąd: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Błąd: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        echo "Brak ID użytkownika.";
    }
} else {
    echo "Nieprawidłowa metoda żądania.";
    exit;
}
?>
