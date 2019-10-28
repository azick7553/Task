<form action="/TaskManager/AddTask" method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="UserName">Имя пользователя</label>
            <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Имя пользователя" required>
        </div>
        <div class="form-group col-md-6">
            <label for="Email">Email</label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required>
        </div>
    </div>
    <div class="form-group">
        <label for="TaskMesssage">Текст задачи</label>
        <textarea class="form-control" style="min-height:150px; max-height:300px" id="TaskMesssage" name="TaskMesssage" placeholder="Текст задачи" required></textarea>
    </div>
    <!-- <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="IsCompleted">
            <label class="form-check-label" for="IsCompleted">
                Выполнено
            </label>
        </div>
    </div> -->
    <button type="submit" style="float:right" class="btn btn-primary">Сохранить</button>
</form>