<html lang="zh-TW">

<head>
    <?php view('components.header'); ?>
    <title>商品列表</title>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main class="m-5">
        <div class="main-title text-center">
            <h1>商品列表</h1>
        </div>

        <table class="table table-hover">
            <thead>
                <tr class="table-dark">
                    <th>圖片</th>
                    <th>名稱</th>
                    <th>價格</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($products) && is_array($products)) { ?>
                    <?php foreach ($products as ['id' => $id, 'photo' => $photo, 'name' => $name, 'price' => $price]) { ?>
                        <tr>
                            <td>
                                <a href="/products/<?php echo $id; ?>">
                                    <img src="<?php echo PUBLIC_PATH . '/' . $photo; ?>" alt="<?php echo $name; ?>">
                                </a>
                            </td>

                            <td>
                                <?php echo $name; ?>
                            </td>

                            <td>
                                <?php echo $price; ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>