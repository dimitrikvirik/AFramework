<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= Page::$title ?></title>
    <!-- Include css-->
    <?php foreach (Page::$conf["css"] as $key): ?>
    <link href="/resources/static/css/<?=$key?>.css" rel="stylesheet" type="text/css">
    <?php endforeach; ?>
    <link rel="shortcut icon" type="image/jpg" href="/resources/static/favicon.ico"/>
    <!-- Include Js -->
    <?php foreach (Page::$conf["js"] as $key): ?>
        <script src="/resources/static/js/<?=$key?>.js" defer></script>
    <?php endforeach; ?>
</head>
<body>
<?php
  if(Page::$conf["useHeader"])  Page::extend("header");
    Page::yield("content");
if(Page::$conf["useFooter"])  Page::extend("footer");
?>
</body>
</html>