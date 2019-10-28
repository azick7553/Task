<style>
</style>
<div class="text-center">
    <div class="col-lg-4">
        <?php
        foreach ($data as $key => $val)
            echo "<span style=\"color:red;\">$val</span>";
        ?>
    </div>
</div>
<form class="form-signin text-center" action="/Account/LogIn" method="post">
    <div class="row" style="margin:0">
        <div class="col-lg-4">
            <h1 class="h3 mb-3 font-weight-normal">Выполните вход</h1>
            <input type="text" id="UserName" name="UserName" class="form-control" placeholder="Логин" required="" autofocus="" />
            <br />
            <input type="password" id="Password" name="Password" placeholder="Пароль" class="form-control" required="" />
            <hr />
            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход" />
        </div>
    </div>
</form>