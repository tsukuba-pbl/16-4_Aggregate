<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ファイルアップロード</title>
</head>
<body>
    <!--<form action="https://ts-quartetto.herokuapp.com/sprint1_9/receive_file.php" method="post">-->
    <form enctype="multipart/form-data" action="receive_file.php" method="post">
        <input type="file" name="file">
        <input type="submit">
    </form>
</body>
</html>