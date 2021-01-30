<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    if (empty($_FILES)) {
    } else {
        // var_dump($_FILES);
        foreach ($_FILES["pictures"]["error"] as $key => $error) {
            var_dump($_FILES);
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
                // basename() может спасти от атак на файловую систему;
                // может понадобиться дополнительная проверка/очистка имени файла
                $name = basename($_FILES["pictures"]["name"][$key]);
                move_uploaded_file($tmp_name, "img/" . $name);
            }
        }
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <p>Изображения:
            <input type="file" name="pictures[]" />
            <input type="file" name="pictures[]" />
            <input type="file" name="pictures[]" />
            <input type="submit" value="Отправить" />
        </p>
    </form>

</body>

</html>