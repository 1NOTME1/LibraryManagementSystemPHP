<?php
if (isset($_GET['book_id'])) {
    $bookID = $_GET['book_id'];

    include 'config.php';

    $sql = "SELECT Tytul, Autor, Rok_wydania, Stan FROM Ksiazki WHERE KsiazkaID = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $bookID);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($book = mysqli_fetch_assoc($result)) {
            $tytul = $book['Tytul'];
            $autor = $book['Autor'];
            $rok_wydania = $book['Rok_wydania'];
            $stan = $book['Stan'];
        } else {
            echo "Nie znaleziono książki o ID: $bookID";
            exit;
        }
    } else {
        echo "Błąd: " . mysqli_error($conn);
        exit;
    }
    mysqli_close($conn);
} else {
    echo "Brak ID książki.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Książkę</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="register-container">
    <h1>Edytuj Książkę</h1>
    <form action="update_book.php" method="post">
        <input type="hidden" name="KsiazkaID" value="<?php echo htmlspecialchars($bookID); ?>">

        <label for="title">Tytuł:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($tytul); ?>" required>

        <label for="author">Autor:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($autor); ?>" required>

        <label for="year">Rok wydania:</label>
        <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($rok_wydania); ?>" required>

        <label for="status">Stan:</label>
        <select id="status" name="status" required>
            <option value="Dostępna" <?php echo $stan == 'Dostępna' ? 'selected' : ''; ?>>Dostępna</option>
            <option value="Wypożyczona" <?php echo $stan == 'Wypożyczona' ? 'selected' : ''; ?>>Wypożyczona</option>
        </select>

        <input type="submit" value="Aktualizuj książkę">
    </form>
</div>
</body>
</html>
