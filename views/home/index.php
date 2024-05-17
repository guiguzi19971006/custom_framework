<html lang="zh-TW">

<head>
    <?php view('components.header'); ?>
    <title>首頁</title>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main class="m-5">
        <div class="m-5 p-5 text-bg-secondary rounded">
            <div class="d-flex justify-content-between p-3">
                <h2>熱門產品</h2>
                <a class="text-light" href="/products/hottest">更多商品</a>
            </div>
            
            <div class="d-flex p-3">
                <?php foreach ($theHottestProducts as ['product_id' => $id, 'product_photo' => $photo, 'product_name' => $name, 'product_price' => $price, 'product_description' => $description]) { ?>
                    <div class="card flex-fill">
                        <img src="<?php echo PUBLIC_PATH . '/' . $photo; ?>" alt="<?php echo $name; ?>" class="card-img-top">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?php echo $name; ?>
                            </h4>
                            <p class="card-text">
                                <?php echo $description; ?>
                            </p>
                            <a href="/products/<?php echo $id; ?>" class="btn btn-dark">
                                查看詳細資訊
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>