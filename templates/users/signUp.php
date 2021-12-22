<?php include __DIR__ . '/../header.php'; ?>
<div>
    <div class="users-signup-form-block">
         <h1>Регистрация</h1>
        <form action="/users/register" method="post">
        <div class="field">
            <div class="label">Nickname</div><input type="text" name="nickname">
        </div>
        <div class="field">
            <div class="label">Email</div><input type="text" name="email">
        </div>
        <div class="field">
            <div class="label">Пароль</div><input type="password" name="password">
        </div>
        <input class="submit" type="submit" value="Зарегистрироваться">
        </form>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>