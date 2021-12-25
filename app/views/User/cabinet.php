<!-- user_cabinet -->
<div class="main-agileits">
    <h1>Особистий кабінет</h1>
    <div class="mainw3-agileinfo">
        <!-- login form -->
        <div class="login-form">
            <div class="login-agileits-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <p>Ім`я: <a class="user_cabinet"><?=($user_cabinet['name']) ?></a></p>
                             <p>Логін: <a class="user_cabinet"><?=($user_cabinet['login']) ?></a></p>
                             <p>E-mail: <a class="user_cabinet"><?=($user_cabinet['email']) ?></a></p>
                            <p>Телефон: <a class="user_cabinet"><?=($user_cabinet['phone']) ?></a></p>
                        </div>
                        <div class="col-md-4">
                            <img class="img_cabinet" src="images/<?=($user_cabinet['img']) ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php if($_SESSION['user']['id'] == $user_cabinet['id']): ?>
                <a href="user/edit"><div class="button-container">Змінити особисті дані</a></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- //user_cabinet -->