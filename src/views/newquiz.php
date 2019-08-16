<div class="container-fluid d-flex flex-column h-100 justify-content-center align-items-center">
    <div class="container-fluid d-flex justify-content-end align-items-start">
        <form action="/logout">
            <input type="submit" value="Iziet" class="btn btn-success"/>
        </form>
    </div>
    <div class="container-fluid d-flex justify-content-start">
        <form action="/save-quiz-title" method="post">
            Testa nosaukums: <input type="text" name="title">
            <input type="submit" value="Saglabāt">
        </form>
    </div>
</div>