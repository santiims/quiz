<?php

use Quiz\View;

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <ul>
            <?php foreach (\Quiz\Session::getInstance()->getMessages(\Quiz\Session::TYPE_MESSAGE, true) as $message): ?>
                <li><?= $message ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>