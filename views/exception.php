<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>An exception was encountered!</title>
</head>

<body>
    <h2>An exception was encountered!</h2>
    <table>
        <?php foreach ($exception as $key => $value) { ?>
            <tr>
                <th><?php echo $key; ?></th>
                <td><?php echo $value; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>