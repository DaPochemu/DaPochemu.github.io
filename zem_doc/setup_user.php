<?php
require 'db.php';
$username = 'admin';
$password = 'admin';
$fullName = 'Главный администратор';
$role = 'admin';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT IGNORE INTO users (username, password_hash, full_name, role) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$username, $hashed_password, $fullName, $role])) {
    echo "Пользователь '$username' успешно создан! Теперь удалите файл setup_user.php.";
} else {
    echo "Ошибка или пользователь уже существует.";
}
?>