<!DOCTYPE html>
<html>
<head>
    <base href="/">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/ico" />
    <?=$this->getMeta();?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- Custom Theme files -->
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/font-awesome.css" rel="stylesheet">		<!-- font-awesome icons -->
    <link type="text/css" rel="stylesheet" href="css/chat.css" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--web font-->
    <!-- //web font -->
</head>
<body>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- js -->
<script src="js/jquery_3.3.1.min.js"></script>
<script src="js/validator.js"></script>
<script src="js/ajaxupload.js"></script>
<script src="js/chat.js"></script>
<!-- //js -->
<?=$content;?>
<!-- copyright -->
<div class="w3copyright-agile">
    <p>© 2018-<?php echo date("Y");?>  All rights reserved | Розробка та підтримка <a href="https://eter.dp.ua/" target="_blank">Eter.dp.ua</a></p>
</div>
<!-- //copyright -->
</body>
</html>