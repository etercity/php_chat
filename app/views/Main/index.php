<!-- main -->
<div class="main-agileits">
    <h1>Чат друзів</h1>
    <div class="mainw3-agileinfo">
        <!-- login form -->
        <div class="login-form">
            <div class="login-agileits-top">
                <form action="user/login" method="post">
                    <div class="form-group has-feedback">
                        <p>Login</p>
                        <input type="text" name="login" id="login" class="form-control" placeholder="Login" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Пароль</p>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"  required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <label class="anim">
                        <input type="checkbox" class="checkbox">
                        <span> Remember me ?</span>
                    </label>
                    <input type="submit" value="Login">
                </form>
            </div>
            <div class="login-agileits-bottom">
                <h6><a href="user/signup">Реєстрація</a></h6>
            </div>
        </div>
    </div>
</div>
<!-- //main -->