<?php

use Quiz\View;
/**
 * @var View $this
 */

$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');

?>
<div class="row">
    <div class="col-md-4 offset-md-4">
        <form action="/loginCheck" method="POST">

            <?php
            if (\Quiz\Session::getInstance()->hasErrors()) {
                echo "<ul>";
                foreach (\Quiz\Session::getInstance()->getErrors(true) as $error) {
                    echo "<li>" . $error . "</li>";
                }
                echo "</ul>";
            }
            ?>

            <div class="form-group">
                <input type="text" name="email" placeholder="E-pasts" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Parole" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Ieiet</button>
            </div>
        </form>
        <form action="/register">
            <button class="btn btn-success">Reģistrēties</button>
        </form>
    </div>
</div>

