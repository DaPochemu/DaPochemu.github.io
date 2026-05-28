<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cadastral_number = $_POST['cadastral_number'];
    $doc_title = $_POST['doc_title'];
    $doc_type = $_POST['doc_type'];
    
    if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileTmpPath = $_FILES['document_file']['tmp_name'];
        $fileName = $_FILES['document_file']['name'];
        
        $newFileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "", basename($fileName));
        $destPath = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $sql = "INSERT INTO documents (cadastral_number, doc_title, doc_type, file_path) 
                    VALUES (:cadastral_number, :doc_title, :doc_type, :file_path)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':cadastral_number' => $cadastral_number,
                ':doc_title' => $doc_title,
                ':doc_type' => $doc_type,
                ':file_path' => $destPath
            ]);
            header('Location: index.php');
            exit;
        } else {
            echo "Ошибка при сохранении файла на сервер.";
        }
    } else {
        echo "Ошибка загрузки файла. Возможно, файл слишком велик.";
    }
} else {
    echo "Некорректный метод запроса.";
}
?>