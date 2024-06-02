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
            <form id="user-registration-form">
                <div class="mb-3">
                    <label for="name" class="form-label">真實姓名</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="請輸入真實姓名" aria-describedby="message-invalid-name">
                    <div class="invalid-feedback" id="message-invalid-name"></div>
                </div>

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

                <div class="mb-3">
                    <label for="phone" class="form-label">手機號碼</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="請輸入手機號碼" aria-describedby="message-invalid-phone">
                    <div class="invalid-feedback" id="message-invalid-phone"></div>
                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">生日</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" aria-describedby="message-invalid-birthday">
                    <div class="invalid-feedback" id="message-invalid-birthday"></div>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">生理性別</label>
                    <select name="gender" id="gender" class="form-select" aria-describedby="message-invalid-gender">
                        <option selected>請選擇生理性別</option>
                        <option value="M">男</option>
                        <option value="F">女</option>
                    </select>
                    <div class="invalid-feedback" id="message-invalid-gender"></div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">住址</label>
                    <textarea class="form-control" rows="5" cols="30" name="address" id="address" placeholder="請輸入住址"></textarea>
                </div>

                <div class="text-center">
                    <button class="btn btn-dark" type="submit">註冊</button>
                </div>
            </form>

            <div class="text-center">
                <p>或是</p>
                <a href="/users/login" class="text-dark">登入</a>
            </div>
        </div>
    </main>

    <?php view('components.footer'); ?>

    <script src="<?php echo PUBLIC_PATH; ?>/js/user/register.js?t=<?php echo time(); ?>"></script>
</body>

</html>