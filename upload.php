<?php
// Database credentials
$host = 'localhost';
$dbname = 'login';
$user = 'root';
$password = '';
try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle file upload
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_file'])) {
        $file = $_FILES['pdf_file'];

        // Validate file type
        if ($file['type'] !== 'application/pdf') {
            throw new Exception('Only PDF files are allowed.');
        }

        // Get file data
        $fileName = $file['name'];
        $fileData = file_get_contents($file['tmp_name']);

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO pdf_files (file_name, file_data) VALUES (:file_name, :file_data)");
        $stmt->bindParam(':file_name', $fileName);
        $stmt->bindParam(':file_data', $fileData, PDO::PARAM_LOB);
        $stmt->execute();

        echo "<p class='alert success'>File uploaded successfully!</p>";
    }

    // Handle file deletion
    if (isset($_GET['delete_id'])) {
        $deleteId = (int) $_GET['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM pdf_files WHERE id = :id");
        $stmt->bindParam(':id', $deleteId, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect to prevent duplicate actions on refresh
        header("Location: upload.php");
        exit;
    }

    // Fetch all uploaded files
    $stmt = $pdo->query("SELECT id, file_name FROM pdf_files");
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "<p class='alert error'>Error: " . $e->getMessage() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Manage PDFs</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #1d4ed8;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="file"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            color: #333;
        }

        button {
            padding: 12px 20px;
            background-color: #1d4ed8;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2563eb;
        }

        h2 {
            font-size: 20px;
            color: #333;
            margin-top: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f1f5f9;
            color: #1d4ed8;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        td a {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        td a:hover {
            color: #2563eb;
        }

        .delete-button {
            color: #e53e3e;
            font-weight: bold;
            margin-left: 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .delete-button:hover {
            color: #c53030;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Upload PDF</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="pdf_file">Choose a PDF file:</label>
            <input type="file" name="pdf_file" id="pdf_file" accept=".pdf" required>
            <button type="submit">Upload</button>
        </form>

        <h2>Uploaded PDFs</h2>
        <?php if (count($files) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Action</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?= htmlspecialchars($file['file_name']) ?></td>
                            <td><a href="download.php?id=<?= $file['id'] ?>">Download</a></td>
                            <td><a href="upload.php?delete_id=<?= $file['id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this file?')"
                                    class="delete-button">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No files uploaded yet.</p>
        <?php endif; ?>
    </div>
</body>


</html>
<?php
include("adminPageButton.php"); ?>