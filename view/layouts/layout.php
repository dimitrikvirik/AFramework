<!doctype html>
<html lang="ka">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Page::$conf["title"] ?> | <?= Page::$title ?></title>
    <!-- Include css-->
    <?php foreach (Page::$conf["css"] as $key): ?>
    <link href="/public/css/<?=$key?>.css" rel="stylesheet" type="text/css">
    <?php endforeach; ?>
    <link rel="shortcut icon" type="image/jpg" href="/public/favicon.ico"/>
    <!-- Include Js -->
    <?php foreach (Page::$conf["js"] as $key): ?>
        <script src="/public/js/<?=$key?>.js" defer></script>
    <?php endforeach; ?>
</head>
<body>
<?php
    Page::yield("content");
?>
</body>
</html>