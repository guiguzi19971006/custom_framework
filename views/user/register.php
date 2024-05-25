<html lang="zh-TW">

<head>
    <?php view('components.header'); ?>
    <title>會員註冊</title>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main>
        <div class="text-bg-dark p-3 m-3 text-center">
            <h1>會員註冊</h1>
        </div>

        <div class="bg-light p-3">
            <form action="/users/register" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">電子郵件:</label>
                    <input type="email" class="form-control" id="email" placeholder="請輸入電子郵件" name="email">
                </div>
            </form>
        </div>
    </main>

    <?php view('components.footer'); ?>
</body>

</html>