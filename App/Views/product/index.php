<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
</head>
<body>
    <h1>商品列表</h1>
    <table>
        <thead>
            <tr>
                <th>編號</th>
                <th>名稱</th>
                <th>價格</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as ['id' => $id, 'name' => $name, 'price' => $price]) { ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $price; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>