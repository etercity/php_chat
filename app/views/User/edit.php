<!-- main -->
<div class="main-agileits">
    <h1>Зміна особистих даних</h1>
    <div class="mainw3-agileinfo">
        <!-- login form -->
        <div class="login-form">
            <div class="login-agileits-top">
                <form action="user/edit" id="signup" role="form" method="post" data-toggle="validator">
                    <div class="form-group has-feedback">
                        <p>Пароль</p>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" data-error="Пароль повинен містити не менше 6 символів" data-minlength="6" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Email</p>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?=h($_SESSION['user']['email']);?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Номер телефону</p>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="<?=h($_SESSION['user']['phone']);?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <p>Им`я</p>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?=h($_SESSION['user']['name']);?>" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                        <div class="my-form-selector">
                            <div class="single">
                                <p><small>Рекомендовані розміри аватара: 160х160 px (до 4 MБ)</small></p>
                                <img src="/images/<?= h($_SESSION['user']['img']) ?>" class="ava" alt="" style="max-height: 150px; padding: 12px;">
                            </div>
                            <div id="single" class="sendBtn fa fa-upload fa-3x" aria-hidden="true" data-url="user/add-image" data-name="single"> Завантажити зображення</div>
                        </div>
                    <input type="submit" value="Зберегти зміни">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //main -->
<script src="js/add_img.js"></script>