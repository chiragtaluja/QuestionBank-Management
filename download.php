<?php
$host = 'localhost';
$dbname = 'login';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        $stmt = $pdo->prepare("SELECT file_name, file_data FROM pdf_files WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $file['file_name'] . '"');
            echo $file['file_data'];
            exit;
        } else {
            throw new Exception("File not found.");
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
