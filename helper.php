<?php

if (!function_exists('view')) {
    /**
     * 視覺視圖
     * 
     * @param string $view
     * @param array|null $datas
     * @return void
     */
    function view(string $view, ?array $datas = null): void
    {
        $viewFile = APP_URL . 'Views' . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php';

        if (!file_exists($viewFile)) {
            throw new Exception('The provided file of view does not exist.');
        }

        if ($datas !== null) {
            foreach ($datas as $key => $value) {
                global $$key;
                $$key = $value;
            }
        }

        require_once $viewFile;
    }
}

if (!function_exists('redirect')) {
    /**
     * 重導向
     * 
     * @param string $url
     * @return void
     */
    function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}

if (!function_exists('env')) {
    /**
     * 讀取並取得 .env 檔案內容
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function env(string $key, mixed $default = null): mixed
    {
        $envFilePath = ROOT_PATH . '.env';

        if (!file_exists($envFilePath)) {
            return $default;
        }

        if (($envFileContents = file_get_contents($envFilePath)) === false) {
            return $default;
        }

        $eachLineContent = explode(PHP_EOL, $envFileContents);

        foreach ($eachLineContent as $lineContent) {
            $content = explode('=', trim($lineContent));
            $keyName = $content[0];
            $value = isset($content[1]) && $content[1] !== '' ? $content[1] : $default;

            if ($keyName !== $key) {
                continue;
            }

            $response = $value;
            break;
        }

        return $response ?? $default;
    }
}

if (!function_exists('logging')) {
    /**
     * 將訊息寫入 Log
     * 
     * @param string $message
     * @return bool
     */
    function logging(string $message): bool
    {
        $message = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;

        if (file_put_contents(APP_URL . 'Logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '.log', $message, FILE_APPEND) === false) {
            return false;
        }

        return true;
    }
}

if (!function_exists('base64UrlEncode')) {
    /**
     * 將字串做 base64 encode 處理
     * 
     * @param string $string
     * @return string
     */
    function base64UrlEncode(string $string): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }
}

if (!function_exists('jwtGenerator')) {
    /**
     * 產生 JWT
     * 
     * @param string $secret
     * @return string
     */
    function jwtGenerator(string $secret): string
    {
        $header = base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64UrlEncode(json_encode(['role' => 'admin', 'exp' => time() + 3600 * 24 * 7]));
        $signature = base64UrlEncode(hash_hmac('sha256', $header . '.' . $payload, $secret));
        return $header . '.' . $payload . '.' . $signature;
    }
}

if (!function_exists('jwtVerify')) {
    /**
     * 驗證 JWT
     * 
     * @param string $token
     * @param string $secret
     * @return bool
     */
    function jwtVerify(string $token, string $secret): bool
    {
        $tokenInfos = explode('.', $token);

        if (count($tokenInfos) < 3) {
            return false;
        }

        $encodedHeader = $tokenInfos[0];
        $encodedPayload = $tokenInfos[1];
        $encodedSignature = $tokenInfos[2];
        $originalPayload = json_decode(base64_decode($encodedPayload), true);

        if (!isset($originalPayload['exp']) || $originalPayload['exp'] <= time()) {
            return false;
        }

        $signature = base64UrlEncode(hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secret));

        if ($encodedSignature !== $signature) {
            return false;
        }

        return true;
    }
}
