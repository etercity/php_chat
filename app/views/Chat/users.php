<?php
$online = (time()-60);
$users = \R::findAll('user', "WHERE last_visit > $online");
?>
    <p class="online">On-line користувачі:</p>
<?php foreach($users as $user): ?>
    <?php if ($user['login'] == ($_SESSION['user']['login']) && ($user['role'] != 'admin')): ?>
        <ul class="borderMy">
            <li value="<?=$user['login']?>" class="login">
				<div class="login-img"><img src="/images/<?=($user['img']) ?>" class="img"></div>
				<div class="login-name"><a href="/user/cabinet/?id=<?=$user['id'] ?>" target="_blank" class="at"><?=$user['login']?></a></div>
			</li>
        </ul>
    <? endif; ?>
    <?php if ($user['login'] != ($_SESSION['user']['login']) && ($user['role'] != 'admin')): ?>
        <ul class="border">
            <li value="<?=$user['login']?>" class="login">
				<div class="login-img"><img src="/images/<?=($user['img']) ?>" class="img"></div>
				<div class="login-name"><a href="/user/cabinet/?id=<?=$user['id'] ?>" target="_blank"target="_blank" class="at"><?=$user['login']?></a></div>
			</li>
        </ul>
    <? endif; ?>
    <?php if ($user['role'] == 'admin'): ?>
        <ul class="borderAdm">
            <li value="<?=$user['login']?>" class="login">
				<div class="login-img"><img src="/images/<?=($user['img']) ?>" class="img"></div>
				<div class="login-name"><a href="/user/cabinet/?id=<?=$user['id'] ?>" target="_blank" class="at"><?=$user['login']?></a></div>
			</li>
        </ul>
    <? endif; ?>
<?php endforeach;?>
<script>
    select_user();
</script>