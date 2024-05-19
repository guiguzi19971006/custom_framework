<html lang="zh-TW">

<head>
    <?php view('components.header'); ?>
    <title>商品列表</title>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main>
        <div class="text-bg-dark p-3 m-3 text-center">
            <div class="clearfix align-items-end">
                <h2 class="float-md-start">全部產品</h2>
                <span class="float-md-end">
                    共有 <b><?php echo $productRowNums; ?></b> 項產品，目前在第 <b><?php echo $currentPage; ?></b> 頁
                </span>
            </div>
        </div>

        <div class="bg-light m-3 p-3">
            <?php if (isset($products) && is_array($products)) { ?>
                <?php foreach ($products as ['id' => $id, 'photo' => $photo, 'name' => $name, 'price' => $price, 'description' => $description]) { ?>
                    <div class="card m-3">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="<?php echo PUBLIC_PATH . '/' . $photo; ?>" alt="<?php echo $name; ?>" class="img-fluid rounded-start">
                            </div>

                            <div class="col-md-8 text-center">
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
                    </div>
                <?php } ?>
            <?php } ?>
        </div>

        <ul class="pagination justify-content-center m-3">
            <li class="page-item">
                <a class="page-link" href="?page=1">&lt;|</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo ($currentPage - 1) < 1 ? 1 : $currentPage - 1; ?>">&lt;</a>
            </li>
            <?php for ($i = 1; $i <= $totalPageNums; $i++) { ?>
                <li class="page-item<?php echo $i === $currentPage ? ' active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo ($currentPage + 1) > $totalPageNums ? $totalPageNums : $currentPage + 1; ?>">&gt;</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $totalPageNums; ?>">|&gt;</a>
            </li>
        </ul>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>