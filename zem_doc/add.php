<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавление документа</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Внесение нового документа в базу</h2>
        <a href="index.php" class="btn">← Назад к реестру</a>
        <br><br>
        <form action="process.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Кадастровый номер участка:</label>
                <input type="text" name="cadastral_number" placeholder="Например: 50:14:0000000:123" required>
            </div>
            <div class="form-group">
                <label>Краткое наименование документа:</label>
                <input type="text" name="doc_title" required>
            </div>
            <div class="form-group">
                <label>Тип документа:</label>
                <select name="doc_type" required>
                    <option value="Аренда">Договор аренды</option>
                    <option value="Собственность">Право собственности</option>
                    <option value="Сервитут">Сервитут</option>
                    <option value="Постановление">Постановление Администрации</option>
                    <option value="Иное">Иное</option>
                </select>
            </div>
            <div class="form-group">
                <label>Файл документа (PDF, DOCX):</label>
                <input type="file" name="document_file" accept=".pdf, .doc, .docx" required>
            </div>
            <button type="submit" class="btn">Сохранить документ</button>
        </form>
    </div>
</body>
</html>