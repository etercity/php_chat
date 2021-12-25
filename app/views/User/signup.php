<!-- main -->
<div class="main-agileits">
    <h1>Реєстрація нового користувача</h1>
    <div class="mainw3-agileinfo">
        <!-- login form -->
        <div class="login-form">
            <div class="login-agileits-top">
                <form action="user/signup" id="signup" role="form" method="post" data-toggle="validator">
                    <div class="form-group has-feedback">
                        <p>Login (не більше 13 символів!)</p>
                        <input type="text" name="login" id="login" class="form-control" placeholder="Login" value="<?=isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : '';?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Пароль</p>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" data-error="Пароль повинен містити не менше 6 символів" data-minlength="6" value="<?=isset($_SESSION['form_data']['password']) ? h($_SESSION['form_data']['password']) : '';?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Email</p>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?=isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : '';?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Номер телефону</p>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="<?=isset($_SESSION['form_data']['phone']) ? h($_SESSION['form_data']['phone']) : '';?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Им`я</p>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?=isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : '';?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="register-but">
                        <input type="submit" value="Зареєструватись">
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>
</div>
<!-- //main -->