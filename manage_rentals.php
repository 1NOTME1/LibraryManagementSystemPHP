<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zarządzaj Wypożyczeniami</title>
    <link rel="stylesheet" href="style.css">
</head>
<body background="red">
    <div class="manage-rentals-container">
        <a href="admin.php" class="link-title"><h1>LibraryManagementSystem</h1></a>

        <h2>Zarządzaj Wypożyczeniami</h2>
        <table class="rental-table">
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Rok wydania</th>
                    <th>Wypożyczył</th>
                    <th>Data wypożyczenia</th>
                    <th>Data zwrotu</th>
                    <th>Operacje</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'config.php';

            $sql = "SELECT Ksiazki.Tytul, Ksiazki.Autor, Ksiazki.Rok_wydania, Uzytkownicy.Login AS Wypozyczajacy, Wypozyczenia.Data_wypozyczenia, Wypozyczenia.Data_zwrotu, Wypozyczenia.WypozyczenieID
                    FROM Wypozyczenia
                    JOIN Ksiazki ON Wypozyczenia.KsiazkaID = Ksiazki.KsiazkaID
                    JOIN Uzytkownicy ON Wypozyczenia.CzytelnikID = Uzytkownicy.UzytkownikID
                    ORDER BY Wypozyczenia.Data_zwrotu IS NULL DESC, Wypozyczenia.Data_zwrotu DESC, Wypozyczenia.Data_wypozyczenia DESC";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($wypozyczenie = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($wypozyczenie['Tytul']) . "</td>";
                    echo "<td>" . htmlspecialchars($wypozyczenie['Autor']) . "</td>";
                    echo "<td>" . htmlspecialchars($wypozyczenie['Rok_wydania']) . "</td>";
                    echo "<td>" . htmlspecialchars($wypozyczenie['Wypozyczajacy']) . "</td>";
                    echo "<td>" . htmlspecialchars($wypozyczenie['Data_wypozyczenia']) . "</td>";
                    echo "<td>" . (is_null($wypozyczenie['Data_zwrotu']) ? "Nie zwrócono" : htmlspecialchars($wypozyczenie['Data_zwrotu'])) . "</td>";
                    echo "<td>";

                    if (is_null($wypozyczenie['Data_zwrotu'])) {
                        echo "<form action='return_book.php' method='post' onsubmit='return confirm(\"Czy na pewno chcesz zwrócić tę książkę?\");'>";
                        echo "<input type='hidden' name='loan_id' value='" . $wypozyczenie['WypozyczenieID'] . "' />";
                        echo "<input type='submit' class='return-button-red' value='Nie zwrócona'  />";
                        echo "</form>";
                    } else {
                        echo "<span class='return-button-green'>Zwrócona</span>";
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Brak wypożyczeń.</td></tr>";
            }
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
