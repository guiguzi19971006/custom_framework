<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊成功通知信</title>
</head>

<body>
    <p>
        親愛的 <b><?php echo $name; ?></b> 您好，您已完成會員註冊，請於 15 分鐘內點擊下方連結以完成會員身分驗證:
    </p>
    <a href="<?php echo env('SITE_URL'); ?>/users/verify/<?php echo $token; ?>">
        <?php echo env('SITE_URL'); ?>/users/verify/<?php echo $token; ?>
    </a>
</body>

</html>