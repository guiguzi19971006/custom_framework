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
                    <th>描述</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($products) && is_array($products)) { ?>
                    <?php foreach ($products as ['id' => $id, 'photo' => $photo, 'name' => $name, 'price' => $price, 'description' => $description]) { ?>
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

                            <td>
                                <?php echo $description; ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td class="text-center" colspan="3">暫無產品</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="?page=1"><<|</a>
            </li>
            <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($currentPage - 1) < 1 ? 1 : $currentPage - 1; ?>"><</a>
                </li>
            <?php for ($i = 1; $i <= $totalPageNums; $i++) { ?>
                <li class="page-item<?php echo $i === $currentPage ? ' active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php } ?>
            <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($currentPage + 1) > $totalPageNums ? $totalPageNums : $currentPage + 1; ?>">></a>
                </li>
            <li class="page-item">
                <a class="page-link" href="?page=<?php echo $totalPageNums; ?>">|>></a>
            </li>
        </ul>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>