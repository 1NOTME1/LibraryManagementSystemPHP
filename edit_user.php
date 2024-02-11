<?php
if (isset($_GET['uzytkownikID'])) {
    $uzytkownikID = $_GET['uzytkownikID'];
  
    include 'config.php';
    
    $sql = "SELECT Imie, Nazwisko, Numer_telefonu, Login, Haslo, Rola FROM Uzytkownicy WHERE UzytkownikID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        
        mysqli_stmt_bind_param($stmt, "i", $uzytkownikID);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($user = mysqli_fetch_assoc($result)) {
         
            $imie = $user['Imie'];
            $nazwisko = $user['Nazwisko'];
            $numer_telefonu = $user['Numer_telefonu'];
            $login = $user['Login'];
            $haslo = $user['Haslo'];
            $rola = $user['Rola'];
        } else {
            echo "Nie znaleziono użytkownika o ID: $uzytkownikID";
        }
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "Brak ID użytkownika.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Użytkownika</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="register-container">
    <h1>Edytuj Użytkownika</h1>
    <form action="update_user.php" method="post">
        <input type="hidden" name="uzytkownikID" value="<?php echo htmlspecialchars($uzytkownikID); ?>">
        
        <label for="fname">Imię:</label>
        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($imie); ?>" required>
        
        <label for="lname">Nazwisko:</label>
        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($nazwisko); ?>" required>
        
        <label for="phone">Numer telefonu:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($numer_telefonu); ?>" required>
        
        <label for="username">Login:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($login); ?>" required>
        
        <label for="password">Hasło (pozostaw puste, jeśli nie chcesz zmieniać):</label>
        <input type="password" id="password" name="password">

        <label for="confirm_password">Potwierdź hasło:</label>
        <input type="password" id="confirm_password" name="confirm_password">


        
        <label for="role">Rola:</label>
        <select id="role" name="role" required>
            <option value="Uzytkownik" <?php echo $rola == 'Uzytkownik' ? 'selected' : ''; ?>>Użytkownik</option>
            <option value="Admin" <?php echo $rola == 'Admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
        
        <input type="submit" value="Aktualizuj użytkownika">
    </form>
</div>
</body>
</html>
