<?php

use Quiz\Models\QuizModel;
use Quiz\View;

/**
 * @var View $this
 * @var QuizModel[] $params
 * @var array $quizData
 */

$userName = \Quiz\ActiveUser::getLoggedInUser()->name;    //šādi mēs...

?>
<div class="container-fluid d-flex flex-column h-100 align-items-center justify-content-start">
    <div class="container-fluid d-flex justify-content-end align-items-start">
    <form action="/logout">
        <input type="submit" value="Iziet" class="btn btn-success"/>
    </form>
    </div>
<?php if (\Quiz\ActiveUser::isLoggedIn()): ?>
    <quiz :name='<?= json_encode($userName); /* ...padodam datus no backenda uz frontendu */ ?>' :quizzes-prop='<?= json_encode($quizData); ?>'></quiz>
<?php endif; ?>


</div>