

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
</head>
<body>
    <h2>Add Book Information</h2>

    <?php
    $host = "your_mysql_host";
    $username = "your_mysql_username";
    $password = "your_mysql_password";
    $database = "library";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accession_number = $_POST["accession_number"];
        $title = $_POST["title"];
        $authors = $_POST["authors"];
        $edition = $_POST["edition"];
        $publisher = $_POST["publisher"];

        // Insert data into the database
        $sql = "INSERT INTO books (accession_number, title, authors, edition, publisher)
                VALUES ('$accession_number', '$title', '$authors', '$edition', '$publisher')";

        if (mysqli_query($conn, $sql)) {
            echo "<p>Book information added successfully!</p>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Search for a book by title
    if (isset($_POST["search_title"])) {
        $search_title = $_POST["search_title"];
        $sql_search = "SELECT * FROM books WHERE title LIKE '%$search_title%'";
        $result_search = mysqli_query($conn, $sql_search);

        if (mysqli_num_rows($result_search) > 0) {
            echo "<h2>Search Results</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Accession Number</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                    </tr>";

            while ($row = mysqli_fetch_assoc($result_search)) {
                echo "<tr>
                        <td>{$row['accession_number']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['authors']}</td>
                        <td>{$row['edition']}</td>
                        <td>{$row['publisher']}</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No books found with the specified title.</p>";
        }
    }

    mysqli_close($conn);
    ?>

    <h3>Enter Book Information</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="accession_number">Accession Number:</label>
        <input type="text" name="accession_number" required><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="authors">Authors:</label>
        <input type="text" name="authors" required><br>

        <label for="edition">Edition:</label>
        <input type="text" name="edition" required><br>

        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" required><br>

        <input type="submit" value="Add Book">
    </form>

    <h3>Search for a Book by Title</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search_title">Enter Title:</label>
        <input type="text" name="search_title" required>
        <input type="submit" value="Search">
    </form>
</body>
</html>
