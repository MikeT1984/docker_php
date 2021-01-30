<?php

if (!empty($_FILES)) {
    foreach ($_FILES["pictures"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
            // basename() может спасти от атак на файловую систему;
            $name = basename($_FILES["pictures"]["name"][$key]);
            move_uploaded_file($tmp_name, "img/" . $name);
        }
    }

    function excess($files)
    {
        $result = array();
        for ($i = 0; $i < count($files); $i++) {
            if ($files[$i] != "." && $files[$i] != ".." && $files[$i] != ".DS_Store") $result[] = $files[$i];
        }
        return $result;
    }

    $dir = "img"; // Путь к директории, в которой лежат изображения
    $files = scandir($dir); // Получаем список файлов из этой директории
    $files = excess($files); // Удаляем лишние файлы
    /* Дальше происходит вывод изображений на страницу сайта (по 4 штуки на одну строку) */
?>
    <?php for ($i = 0; $i < count($files); $i++) { ?>
        <a href="<?= $dir . "/" . $files[$i] ?>" target="_blank">
            <img style="border: 0px solid ; width: 323px; height: 323px;" alt="" src="<?= $dir . "/" . $files[$i] ?>"></a>
        <!-- Выводим картинки на экран в виде сылок,при нажатие на картинку открываем ее в полном размере в новом окне  -->
        <?php if (($i + 1) % 4 == 0) { ?><br /><?php } ?>
        <!-- Ограничеваем вывод картинок не более 4 -->
<?php }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Загрузка файла</title>
</head>

<body>
    <form enctype="multipart/form-data" method="post">
        <p>Загрузите ваши фотографии на сервер</p>
        <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
        <p><input type="file" name="pictures[]" multiple accept="image/*,image/jpeg">
            <!-- При загрузке изображения делаем проверку на тип и размер файла -->
            <!-- Можем загрузить несколько файлов -->
            <input type="submit" value="Отправить">
        </p>
    </form>
</body>

</html>