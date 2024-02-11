<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zarządzaj Użytkownikami</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="manage-users-container">
        <a href="admin.php" class="link-title"><h1>LibaryManagmentSystem</h1></a>
        
        <h2>Dodaj nowego użytkownika</h2>
        <form action="add_user.php" method="post">
            Imię: <input type="text" name="fname"><br>
            Nazwisko: <input type="text" name="lname"><br>
            Numer Telefonu: <input type="tel" name="phone"><br>
            Login: <input type="text" name="username"><br>
            Hasło: <input type="password" name="password"><br>
            <input type="submit" value="Dodaj użytkownika">
        </form>

        <h2>Lista użytkowników</h2>
        <table>
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Login</th>
                    <th>Operacje</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include 'config.php';

                $sql = "SELECT UzytkownikID, Imie, Nazwisko, Login FROM Uzytkownicy";
                $result = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result) > 0) {
                    while ($uzytkownik = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($uzytkownik['Imie']) . "</td>";
                        echo "<td>" . htmlspecialchars($uzytkownik['Nazwisko']) . "</td>";
                        echo "<td>" . htmlspecialchars($uzytkownik['Login']) . "</td>";
                        echo "<td>";
                        
                        echo "<a href='edit_user.php?uzytkownikID=" . $uzytkownik['UzytkownikID'] . "' class='button-link'>";
                        echo "<button class='edit-link'>Edytuj</button>";
                        echo "</a>";
                    
                        echo "<form action='delete_user.php' method='post' onsubmit='return confirm(\"Czy na pewno chcesz usunąć tego użytkownika?\");'>";
                        echo "<input type='hidden' name='uzytkownikID' value='" . $uzytkownik['UzytkownikID'] . "'>";
                        echo "<button type='submit' class='delete-button'>Usuń</button>";
                        echo "</form>";
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                    
                } else {
                    echo "<tr><td colspan='4'>Brak użytkowników.</td></tr>";
                }
                mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
