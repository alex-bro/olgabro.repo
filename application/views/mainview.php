<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />

    <?php foreach($styles as $style){ ?>
        <link href="<?php echo URL::base(); ?>public/css/<?php echo $style; ?>.css"
              rel="stylesheet" type="text/css" />
    <?php } ?>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <title><?php echo $title; ?></title>
</head>
<body>
<div id="header">
    <div id="headerTopLine"></div>
    <div id="headerBody">
        <div id="containerHeader">
            <div id="logo"><img src="/public/images/ob_logo.png" alt="logo"/></div>
            <div id="contact">
                <?php echo $phone; ?><br/>
                <?php echo $email; ?>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div id="bg">
    <div id="content">

        <?php echo $content; ?>

    </div>
</div>
<div class="clear"></div>
<div id="footer">
    <div id="containerFooter">
        <div id="copy">&copy;  2014 «OlgaBronnikova» Web-designer</div>
        <div id="olgabro">Разработка сайта OLGABRO</div>
    </div>
</div>

</body>
</html>