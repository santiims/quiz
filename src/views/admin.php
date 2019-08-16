<?php

$userName = \Quiz\ActiveUser::getLoggedInUser()->name;

?>

<div class="container-fluid d-flex flex-column h-100 justify-content-center align-items-center">
    <div class="container-fluid d-flex justify-content-end align-items-start">
        <form action="/logout">
            <input type="submit" value="Iziet" class="btn btn-success"/>
        </form>
    </div>
    <div class="container-fluid d-flex justify-content-start">
        <form action="/new" method="post">
            <input class="btn btn-success" type="submit" value="Jauns tests">
        </form>
    </div>
</div>