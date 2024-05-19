<html lang="zh-TW">

<head>
    <?php view('components.header'); ?>
    <title>首頁</title>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main>
        <div class="text-bg-dark p-3 m-3 text-center">
            <h2>熱門產品</h2>
        </div>

        <div class="bg-light m-3 p-3 row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($theHottestProducts as ['product_id' => $id, 'product_photo' => $photo, 'product_name' => $name, 'product_price' => $price, 'product_description' => $description]) { ?>
                <div class="col">
                    <div class="card m-3 text-center">
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
                </div>
            <?php } ?>
        </div>

        <div class="text-center">
            <a href="/products/hottest" class="btn btn-dark">看更多商品</a>
        </div>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>