<div class="container-fluid d-flex flex-column h-100 justify-content-center align-items-center">
    <div class="container-fluid d-flex justify-content-end align-items-start">
        <form action="/logout">
            <input type="submit" value="Iziet" class="btn btn-success"/>
        </form>
    </div>
    <div class="container-fluid d-flex flex-column justify-content-start">
        <form action="/save-question" method="post">
            Jautājums: <input type="text" name="text">
            Atbilžu varianti:
            <ol>
                <li>
                    <input type="text" name="answer1"> Pareiza atbilde: <input type="checkbox" name="correct1">
                </li>
                <li>
                    <input type="text" name="answer2"> Pareiza atbilde: <input type="checkbox" name="correct2">
                </li>
                <li>
                    <input type="text" name="answer3"> Pareiza atbilde: <input type="checkbox" name="correct3">
                </li>
                <li>
                    <input type="text" name="answer4"> Pareiza atbilde: <input type="checkbox" name="correct4">
                </li>
            </ol>
            <input type="submit" value="Saglabāt" class="btn btn-success">
        </form>
        <form action="/finished" method="post">
            <input type="submit" value="Pabeigts" class="btn btn-success">
        </form>
    </div>
</div>