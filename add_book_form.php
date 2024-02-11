<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Książkę</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="add-book-container">
        <a href="admin.php" class="link-title"><h1>LibraryManagementSystem</h1></a>
        <h2>Dodaj Książkę</h2>
        <form action="add_book.php" method="post" class="add-book-form">
            <div class="form-group">
                <label for="title">Tytuł:</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="author">Autor:</label>
                <input type="text" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label for="year">Rok wydania:</label>
                <input type="text" id="year" name="year" required>
            </div>

            <div class="form-group">
                <label for="status">Stan:</label>
                <select id="status" name="status" required>
                    <option value="Dostępna">Dostępna</option>
                    <option value="Wypożyczona">Wypożyczona</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" value="Dodaj książkę" class="submit-button">
            </div>
        </form>
    </div>
</body>
</html>
