<?php

use Quiz\View;
/**
 * @var View $this
 */

?>
    <div class="row">
        <div class="col-md-4 offset-md-4">
        <form action="/registerPost" method="POST">

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
                <input type="text" name ="name" placeholder="Name" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Repeat Password" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Register</button>
            </div>
        </form>
            <form action="/login">
                <button class="btn btn-success">Login</button>
            </form>
        </div>
        </div>


