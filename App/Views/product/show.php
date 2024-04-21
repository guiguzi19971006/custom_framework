<html lang="zh-TW">

<head>
    <title>產品資訊 - <?php echo $productId; ?></title>
    <?php view('components.header'); ?>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main class="m-3">
        <h1><?php echo $productId; ?></h1>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>