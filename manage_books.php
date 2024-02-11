<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zarządzaj Książkami</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="manage-books-container">
        <a href="admin.php" class="link-title"><h1>LibraryManagementSystem</h1></a>

        <h2><a href="add_book_form.php" class="add-book-link">Dodaj Książkę</a></h2>

        <h2>Lista Książek</h2>
        
        <table class="book-table">
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Autor</th>
                    <th>Rok wydania</th>
                    <th>Stan</th>
                    <th>Operacje</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'config.php';

            $sql = "SELECT KsiazkaID, Tytul, Autor, Rok_wydania, Stan FROM Ksiazki";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($ksiazka = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($ksiazka['Tytul']) . "</td>";
                    echo "<td>" . htmlspecialchars($ksiazka['Autor']) . "</td>";
                    echo "<td>" . htmlspecialchars($ksiazka['Rok_wydania']) . "</td>";
                    echo "<td>" . htmlspecialchars($ksiazka['Stan']) . "</td>";
                    echo "<td>";
                    echo "<a href='edit_book.php?book_id=" . $ksiazka['KsiazkaID'] . "' class='edit-link'>Edytuj</a> ";
                    echo "<form action='delete_book.php' method='post' onsubmit='return confirm(\"Czy na pewno chcesz usunąć tę książkę?\");' class='delete-form' style='display: inline;'>";
                    echo "<input type='hidden' name='book_id' value='" . $ksiazka['KsiazkaID'] . "'>";
                    echo "<button type='submit' class='delete-button'>Usuń</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Brak dostępnych książek.</td></tr>";
            }
            mysqli_close($conn);
            ?>
            </tbody>
        </table>

        
    </div>
</body>
</html>
