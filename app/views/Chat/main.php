<?php
    $actual_comments = (time()-518400);
    $comments = \R::findAll('comments', "WHERE dead_time > $actual_comments");
    function smile($var){
    $symbol = array(':mellow:',
        '&lt;_&lt;',
        ':)',
        ':wub:',
        ':angry:',
        ':(',
        ':unsure:',
        ':wacko:',
        ':blink:',
        '-_-',
        ':rolleyes:',
        ':huh:',
        '^_^',
        ':o',
        ';)',
        ':P',
        ':D',
        ':lol:',
        'B)',
        ':ph34r:');
    $graph = array(
        '<img src="images/mellow.png">',
        '<img src="images/dry.png">',
        '<img src="images/smile.png">',
        '<img src="images/wub.png">',
        '<img src="images/angry.png">',
        '<img src="images/sad.png">',
        '<img src="images/unsure.png">',
        '<img src="images/wacko.png">',
        '<img src="images/blink.png">',
        '<img src="images/sleep.png">',
        '<img src="images/rolleyes.gif">',
        '<img src="images/huh.png">',
        '<img src="images/happy.png">',
        '<img src="images/ohmy.png">',
        '<img src="images/wink.png">',
        '<img src="images/tongue.png">',
        '<img src="images/biggrin.png">',
        '<img src="images/laugh.png">',
        '<img src="images/cool.png">',
        '<img src="images/ph34r.png">');
    return str_replace($symbol, $graph, $var);
}?>
<?php foreach($comments as $comment): ?>
    <?php if(($comment['user_login']) ==  ($_SESSION['user']['login'])): ?>
        <section>
            <div class="clear"></div>
            <div class="from-me">
                <?php if (!empty($comment['to_whom']) && ($comment['private']) != 1):?>
                    <p class="mess_to">Повідомлення для: <span class="user_login" value="<?=($comment['to_whom']);?>"><?=($comment->to_whom);?></span></p>
                <?php endif;?>
                <?php if (empty($comment['to_whom'])):?>
                    <p class="mess_to">Повідомлення для всіх:</p>
                <?php endif;?>
                <?php if (!empty($comment['to_whom']) && ($comment['private']) == 1):?>
                    <p class="mess_to">Приватне повідомлення для: <span class="user_login" value="<?=($comment['to_whom']);?>"><?=($comment->to_whom);?></span></p>
                <?php endif;?>
                <p><?=nl2br(smile($comment->comment));?></p>
                <?php if(!empty($comment['file_name'])): ?>
                    <p><a href="/uploaded_files/<?= $comment->file_name;?>" download="" class="button9">Завантажити файл</a></p>
                    <p class="file_name"><?= $comment->original_name;?></p>
                <?php endif; ?>
                <p class="mess_time_my">[<?= $comment->date;?>]</p>
            </div>
            <div class="clear"></div>
        </section>
    <?php endif; ?>
    <?php if(($comment['to_whom']) ==  ($_SESSION['user']['login']) && ($comment['private']) == 0): ?>
        <section>
            <div class="clear"></div>
            <img src="/images/<?=($comment['user_img']) ?>" class="img_mess">
            <div class="from-them-to-me">
                <li class="user_login" value="<?=($comment['user_login']);?>"><?=($comment->user_login);?></li> <li class="mess_time_they" value="[<?=($comment['user_login']);?>] [<?= $comment->date;?>]">[<?= $comment->date;?>]</li>
                <p><?=nl2br(smile($comment->comment));?></p>
                <?php if(!empty($comment['file_name'])): ?>
                    <p><a href="/uploaded_files/<?= $comment->file_name;?>" download="" class="button9">Завантажити файл</a></p>
                    <p class="file_name"><?= $comment->original_name;?></p>
                <?php endif; ?>
                <p class="mess_to">Повідолення для: <span class="user_login" value="<?=($comment['to_whom']);?>"><?=($comment->to_whom);?></span></p>
            </div>
            <div class="clear"></div>
        </section>
    <?php endif; ?>
    <?php if(($comment['user_login']) !=  ($_SESSION['user']['login']) & ($comment['to_whom']) != ($_SESSION['user']['login']) & ($comment['private']) == 0): ?>
        <section>
            <div class="clear"></div>
            <img src="/images/<?=($comment['user_img']) ?>" class="img_mess">
            <div class="from-them-to-all">
                <li class="user_login" value="<?=($comment['user_login']);?>"><?=($comment->user_login);?></li> <li class="mess_time_they" value="[<?=($comment['user_login']);?>] [<?= $comment->date;?>]">[<?= $comment->date;?>]</li>
                <p><?=nl2br(smile($comment->comment));?></p>
                <?php if(!empty($comment['file_name'])): ?>
                    <p><a href="/uploaded_files/<?= $comment->file_name;?>" download="" class="button9">Завантажити файл</a></p>
                    <p class="file_name"><?= $comment->original_name;?></p>
                <?php endif; ?>
                <?php if(!empty($comment['to_whom'])): ?>
                    <p class="mess_to">Повідомлення для: <span class="user_login" value="<?=($comment['to_whom']);?>"><?=($comment->to_whom);?></span></p>
                <?php endif; ?>
                <?php if(empty($comment['to_whom'])): ?>
                    <p class="mess_to">Повідомлення для всіх</p>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </section>
    <?php endif; ?>
    <?php if(($comment['to_whom']) ==  ($_SESSION['user']['login']) && ($comment['private']) == 1): ?>
        <section>
            <div class="clear"></div>
            <img src="/images/<?=($comment['user_img']) ?>" class="img_mess">
            <div class="from-them-private">
                <li class="user_login" value="<?=($comment['user_login']);?>"><?=($comment->user_login);?></li> <li class="mess_time_they" value="[<?=($comment['user_login']);?>] [<?= $comment->date;?>]">[<?= $comment->date;?>]</li>
                <p><?=nl2br(smile($comment->comment));?></p>
                <?php if(!empty($comment['file_name'])): ?>
                    <p><a href="/uploaded_files/<?= $comment->file_name;?>" download="" class="button9">Завантажити файл</a></p>
                    <p class="file_name"><?= $comment->original_name;?></p>
                <?php endif; ?>
                <p class="mess_to">Приватне повідомлення для: <span class="user_login" value="<?=($comment['to_whom']);?>"><?=($comment->to_whom);?></span></p>
            </div>
            <div class="clear"></div>
        </section>
        <?php if ($comment['new_mess'] == 1): ?>
            <script>soundClick();</script>
            <?php \R::exec( 'UPDATE `comments` SET `new_mess`="0" WHERE `id` = ?', [$comment['id']] );?>
        <?php endif;?>
    <?php endif; ?>
<?php endforeach; ?>
<script>
    select_user_chat();
</script>
<script>
    select_time();
</script>
