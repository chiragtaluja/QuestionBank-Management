<?php
include("search.php"); ?>
<?php
$host = 'localhost';
$dbname = 'login';
$user = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id, file_name FROM pdf_files");
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded PDFs</title>
    <style>
    body {
        
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f9f9f9;
    color: #333;
    
}

h1 {
    font-size: 24px;
    color: #1d4ed8;
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    max-width: 1175px;
    margin: 0 auto;
    border-collapse: collapse;
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

th, td {
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
</style>
   

</head>

<body>
    <br>
    <br>
    <br>
    <h1>Uploaded Papers</h1>
    <table>
        <thead>
            <tr>
               
                <th>File Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
              
                    <td><?= htmlspecialchars($file['file_name']) ?></td>
                    <td>
                        <a href="download.php?id=<?= $file['id'] ?>">Download</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>


</html>
<?php 
include("homeButton.php");?>


