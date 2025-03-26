<?php
$host = 'localhost';
$dbname = 'login';
$user = 'root';
$password = '';
try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $searchQuery = '';
    $results = [];
    // Handle search request
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
        $searchQuery = trim($_GET['search']);
        $stmt = $pdo->prepare("SELECT id, file_name FROM pdf_files WHERE file_name LIKE :searchQuery");
        $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search PDFs</title>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search PDFs</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f9fafb;
                color: #333;
                display: block;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }

            .container {
                background: #fff;
                width: 1175px;
                padding: 1.5rem;
                margin: auto;
                border-radius: 10px;
                box-shadow: 0 20px 35px rgba(0, 0, 1, 0.9);
            }

            h1 {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 20px;
                color: #1d4ed8;
            }

            form {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
            }

            input[type="text"] {
                flex: 1;
                padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 16px;
                color: #333;
                transition: box-shadow 0.3s ease, border-color 0.3s ease;
            }

            input[type="text"]:focus {
                border-color: #1d4ed8;
                box-shadow: 0 0 8px rgba(29, 78, 216, 0.2);
                outline: none;
            }

            button {
                padding: 10px 20px;
                background-color: #1d4ed8;
                color: #fff;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease, transform 0.2s ease;
            }

            button:hover {
                background-color: #2563eb;
                transform: translateY(-2px);
            }

            h2 {
                font-size: 20px;
                margin-bottom: 15px;
                color: #333;
                text-align: center;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 15px;
            }

            th,
            td {
                padding: 12px;
                text-align: left;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f3f4f6;
                color: #1d4ed8;
                font-weight: bold;
            }

            tr:nth-child(even) {
                background-color: #f9fafb;
            }

            tr:hover {
                background-color: #e3f2fd;
            }

            a {
                color: #1d4ed8;
                text-decoration: none;
                font-weight: bold;
                transition: color 0.3s ease;
            }

            a:hover {
                color: #2563eb;
            }

            .alert {
                padding: 15px;
                font-size: 16px;
                text-align: center;
                border-radius: 5px;
                margin-top: 20px;
            }

            .alert.error {
                color: #b91c1c;
                background-color: #fee2e2;
                border: 1px solid #fca5a5;
            }
        </style>

    </head>


<body>
    <div class="container">
        <h1>Search By Subject Code</h1>
        <form action="search.php" method="get">
            <input type="text" name="search" placeholder="Search by Subject Code (BCA-101, 102, etc...)"
                value="<?= htmlspecialchars($searchQuery) ?>" required>
            <button type="submit">Search</button>
        </form>

        <?php if ($searchQuery): ?>
            <h2>Search Results for "<?= htmlspecialchars($searchQuery) ?>"</h2>
            <?php if (count($results) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $file): ?>
                            <tr>
                                <td><?= htmlspecialchars($file['file_name']) ?></td>
                                <td>
                                    <a href="download.php?id=<?= $file['id'] ?>">Download</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="alert error">No results found for your search.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</body>

</html>
<?php
include("homeButton.php"); ?>