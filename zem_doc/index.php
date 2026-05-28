<?php
require 'auth.php';
require 'db.php';
$stmt = $pdo->query("SELECT * FROM documents ORDER BY upload_date DESC");
$documents = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"> 
    <title>Реестр земельных документов - г.о. Щёлково</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header-panel">
            <div class="user-info">
                Сотрудник: <?= htmlspecialchars($_SESSION['full_name']) ?> (<?= htmlspecialchars($_SESSION['role']) ?>)
            </div>
            <a href="logout.php" class="btn btn-danger">Выйти из системы</a>
        </div>

        <h1>Управление земельными отношениями</h1>
        <h2>Реестр электронных документов</h2>
        <a href="add.php" class="btn">+ Добавить новый документ</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Кадастровый номер</th>
                    <th>Название документа</th>
                    <th>Тип</th>
                    <th>Дата загрузки</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><?= htmlspecialchars($doc['id']) ?></td>
                    <td><strong><?= htmlspecialchars($doc['cadastral_number']) ?></strong></td>
                    <td><?= htmlspecialchars($doc['doc_title']) ?></td>
                    <td><?= htmlspecialchars($doc['doc_type']) ?></td>
                    <td><?= date('d.m.Y H:i', strtotime($doc['upload_date'])) ?></td>
                    <td><a href="<?= htmlspecialchars($doc['file_path']) ?>" target="_blank" class="btn">Скачать / Просмотр</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($documents)): ?>
                <tr><td colspan="6" style="text-align:center;">Документы пока не загружены.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>