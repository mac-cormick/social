<?php include ROOT.'\views\layouts\header.php' ?>;

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1>Вход</h1>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li class="text-danger"> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Ваш E-mail</label>
                        <input class="form-control" type="text" name="email" id="email" value="">
                    </div>
                    <div class="form-group">
                        <label for="password">Ваш пароль</label>
                        <input class="form-control" type="password" name="password" id="password" value="">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Войти"></input>
                    <a href="/register">Регистрация</a>
                </form>
            </div>
        </div>
    </div>

<?php include ROOT.'\views\layouts\footer.php' ?>;