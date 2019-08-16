<?php

use Quiz\View;

/**
* @var View $this
 */


$content = $this->renderContent($params);

//$this->registerJsFile('assets/script.js');
$this->registerCssFile('assets/style.css');
$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
?>

<!doctype html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php foreach ($this->cssFiles as $css): ?>
        <link rel="stylesheet" type="text/css" href="<?= $css ?>">
    <?php endforeach; ?>
</head>
<body>
<div id="app">
    <!--<?= $this->renderView('messages') ?>-->

    <?= $content ?>
</div>
<script src="assets/scripts.js"></script>

</body>
</html>