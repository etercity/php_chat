<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="head_chat">ПРИВІТ ДРУЖЕ!</p>
			</div><div class="clearfix"></div>
		</div>
		<div class="row">
            <div class="col-md-2 display-no-pl">
                <div class="links">
                    <p class="link">Всі користувачі:<b></b></p>
                    <?php
                    $users = \R::findAll('user');
                    ?>
                    <?php foreach ($users as $user):?>
                        <ul class="borderOff">
                            <li value="<?=$user['login']?>" class="login">
                                <div class="login-img"><img src="/images/<?=($user['img']) ?>" class="img"></div>
                                <div class="login-name"><a href="/user/cabinet/?id=<?=$user['id'] ?>" target="_blank" class="at"><?=$user['login']?></a></div>
                            </li>
                        </ul>
                    <?endforeach;?>
                </div>
            </div>
            <div class="col-md-8">
                <div id="chatbox"></div>
            </div>
            <div class="col-md-2">
                <div id="users"></div>
            </div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-1"><span class="hid-me">1</span></div>
            <div class="col-md-4">
                <div class="smiles">
			    <span>
			        <img class="smile" src="images/mellow.png" alt=":mellow:">
		    	</span>
                <span>
                    <img class="smile" src="images/dry.png" alt="&lt;_&lt;">
			    </span>
                <span>
                    <img class="smile" src="images/smile.png" alt=":)">
			    </span>
                <span>
			        <img class="smile" src="images/wub.png" alt=":wub:">
			    </span>
                <span>
			        <img class="smile" src="images/angry.png" alt=":angry:">
			    </span>
                <span>
			        <img class="smile" src="images/sad.png" alt=":(">
			    </span>
                <span>
			        <img class="smile" src="images/unsure.png" alt=":unsure:">
			    </span>
                <span>
			        <img class="smile" src="images/wacko.png" alt=":wacko:">
			    </span>
                <span>
			        <img class="smile" src="images/blink.png" alt=":blink:">
			    </span>
                <span>
			        <img class="smile" src="images/sleep.png" alt="-_-">
			    </span>
                <span>
			        <img class="smile" src="images/rolleyes.gif" alt=":rolleyes:">
			    </span>
                <span>
			        <img class="smile" src="images/huh.png" alt=":huh:">
			    </span>
                <span>
			        <img class="smile" src="images/happy.png" alt="^_^">
			    </span>
                <span>
			        <img class="smile" src="images/ohmy.png" alt=":o">
			    </span>
                <span>
			        <img class="smile" src="images/wink.png" alt=";)">
			    </span>
                <span>
			        <img class="smile" src="images/tongue.png" alt=":P">
			    </span>
                <span>
			        <img class="smile" src="images/biggrin.png" alt=":D">
			    </span>
                <span>
			        <img class="smile" src="images/laugh.png" alt=":lol:">
			    </span>
                <span>
			        <img class="smile" src="images/cool.png" alt="B)">
			    </span>
                <span>
			        <img class="smile" src="images/ph34r.png" alt=":ph34r:">
			    </span>
                </div>
            </div>
            <div class="col-md-5">
                <div class="control-panel">
                    <form action="javascript:send();" class="my-form-selector">
                        <input type="text" id="mess_to_send" size="63" />
                        <div id="file" class="sendBtn fa fa-upload fa-3x" aria-hidden="true" data-url="chat/file" data-name="file"></div>
                        <button type="submit" class="sendBtn">Надіслати</button>
                    </form>
                    <form action="javascript:sendprivate();" class="my-form-selector sp">
                        <button type="submit" class="sendBtn">Приватне</button>
                    </form>
                </div>
            </div>
			<div class="col-md-2">
            	<a href="user/logout"><div class="button-container">Вийти з чату</a></div>
			</div>
        </div>
		<div class="clearfix"></div>
    </div>
</div>

<div class="col-md-2 display-yea-pl">
    <div class="links">
        <p class="link">Всі користувачі:<b></b></p>
        <?php
        $users = \R::findAll('user');
        ?>
        <?php foreach ($users as $user):?>
            <ul class="borderOff">
                <li value="<?=$user['login']?>" class="login">
                    <div class="login-img"><img src="/images/<?=($user['img']) ?>" class="img"></div>
                    <div class="login-name"><a href="/user/cabinet/?id=<?=$user['id'] ?>" target="_blank" class="at"><?=$user['login']?></a></div>
                </li>
            </ul>
        <?endforeach;?>
    </div>
</div>

<iframe src="https://radiovolna.net/embed/?ids=502&logo=1&border=%23000fd4&bg=%23a600ff&title=%231b1c1f" frameborder="0" width="100%" height="55px" scrolling="no"></iframe>
<div class="clearfix"></div>

<script src="js/file.js"></script>
<script>
    //При загрузке страницы подгружаем сообщения
    load_messes();
    //Ставим цикл на каждые три секунды
    setInterval(load_fone_messes,3000);
</script>
<script>
    //При загрузке страницы загружаем ники пользователей
    load_users();
    //Ставим цикл на каждые 59 секунд
    setInterval(load_users,60000);
</script>
<script>
    select_smile();
</script>