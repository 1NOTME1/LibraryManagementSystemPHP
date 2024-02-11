<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje Wypożyczenia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="loans-container">
        <a href="user.php" class="link-title"><h1>LibaryManagmentSystem</h1></a>
        <h2>Moje Wypożyczenia</h2>
        <?php
        session_start();
        include 'config.php';

        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header("location: login.html");
            exit;
        }

        $uzytkownikID = $_SESSION['UzytkownikID'];

        $sql = "SELECT Ksiazki.Tytul, Wypozyczenia.Data_wypozyczenia, Wypozyczenia.Data_zwrotu, Wypozyczenia.WypozyczenieID FROM Wypozyczenia JOIN Ksiazki ON Wypozyczenia.KsiazkaID = Ksiazki.KsiazkaID WHERE CzytelnikID = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $uzytkownikID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo "<table><tr><th>Tytuł</th><th>Data wypożyczenia</th><th>Data zwrotu</th></tr>";
                while ($loan = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . htmlspecialchars($loan['Tytul']) . "</td>";
                    echo "<td>" . htmlspecialchars($loan['Data_wypozyczenia']) . "</td>";
                    echo "<td>" . (empty($loan['Data_zwrotu']) ? "Nie zwrócono" : htmlspecialchars($loan['Data_zwrotu'])) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Brak wypożyczeń.</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Błąd przygotowania zapytania: " . mysqli_error($conn);
        }
        ?>

        <h2>Dostępne książki</h2>
        <?php
        $sql = "SELECT KsiazkaID, Tytul, Autor FROM Ksiazki WHERE Stan = 'Dostępna'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table><tr><th>Tytuł</th><th>Autor</th><th>Akcje</th></tr>";
            while ($book = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . htmlspecialchars($book['Tytul']) . "</td>";
                echo "<td>" . htmlspecialchars($book['Autor']) . "</td>";
                echo "<td><a href='add_loan.php?book_id=" . $book['KsiazkaID'] . "&reader_id=" . $uzytkownikID . "' class='loan-link'>Wypożycz</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Brak dostępnych książek.</p>";
        }
        ?>
    </div>
</body>
</html>
