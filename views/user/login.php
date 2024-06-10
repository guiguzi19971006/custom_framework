<html lang="zh-TW">

<head>
    <?php view('components.header'); ?>
    <title>會員登入</title>
</head>

<body>
    <?php view('components.navbar'); ?>

    <main>
        <div class="text-bg-dark p-3 m-3 text-center">
            <h1>會員登入</h1>
        </div>

        <div class="bg-light p-3">
            <form id="user-login-form">
                <div class="mb-3">
                    <label for="email" class="form-label">電子郵件</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="請輸入電子郵件" aria-describedby="message-invalid-email">
                    <div class="invalid-feedback" id="message-invalid-email"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">密碼</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="請輸入密碼" aria-describedby="message-invalid-password">
                    <div class="invalid-feedback" id="message-invalid-password"></div>
                </div>

                <div class="mb-3 text-center">
                    <input type="checkbox" class="form-check-input" name="is_remembered" id="is_remembered" value="Y">
                    <label for="is_remembered" class="form-check-label">保持登入</label>
                </div>

                <div class="text-center">
                    <button class="btn btn-dark" type="submit">登入</button>
                </div>
            </form>
        </div>
    </main>

    <?php view('components.footer'); ?>

    <script src="<?php echo PUBLIC_PATH; ?>/js/user/login.js?t=<?php echo time(); ?>"></script>
</body>

</html>