<?php

if (!function_exists('view')) {
    /**
     * 視覺視圖
     * 
     * @param string $view
     * @param array|null $datas
     * @param bool $preserve
     * 
     * @return string
     * 
     * @throws \Exception
     */
    function view(string $view, ?array $datas = null, bool $preserve = false)
    {
        $viewFile = VIEW_PATH . str_replace('.', DIRECTORY_SEPARATOR, $view) . '.php';

        if (!file_exists($viewFile)) {
            throw new \Exception('The provided file of view does not exist');
        }

        if ($datas !== null) {
            foreach ($datas as $key => $value) {
                global $$key;
                $$key = $value;
            }
        }

        if ($preserve === true) {
            ob_start();
            require_once $viewFile;
            return ob_get_clean();
        }

        require_once $viewFile;
    }
}

if (!function_exists('redirect')) {
    /**
     * 重導向
     * 
     * @param string $url
     * 
     * @return void
     */
    function redirect(string $url)
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
     * 
     * @return mixed
     * 
     * @throws \Exception
     */
    function env(string $key, mixed $default = null)
    {
        $envFilePath = ROOT_PATH . '.env';

        if (!file_exists($envFilePath)) {
            throw new \Exception("The [$envFilePath] does not exist");
        }

        if (($envFileContents = file_get_contents($envFilePath)) === false) {
            return $default;
        }

        $eachLineContent = explode(PHP_EOL, trim($envFileContents));

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

if (!function_exists('logToFile')) {
    /**
     * 將訊息寫入 Log
     * 
     * @param string $message
     * 
     * @return bool
     */
    function logToFile(string $message)
    {
        $message = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;

        if (file_put_contents(STORAGE_PATH . 'logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '.log', $message, FILE_APPEND) === false) {
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
     * 
     * @return string
     */
    function base64UrlEncode(string $string)
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($string));
    }
}

if (!function_exists('jwtEncode')) {
    /**
     * 產生 JWT
     * 
     * @param array $payload
     * @param string $secret
     * 
     * @return string
     */
    function jwtEncode(array $payload, string $secret)
    {
        $header = base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64UrlEncode(json_encode($payload));
        $signature = base64UrlEncode(hash_hmac('sha256', $header . '.' . $payload, $secret));
        return $header . '.' . $payload . '.' . $signature;
    }
}

if (!function_exists('jwtDecode')) {
    /**
     * 驗證 JWT
     * 
     * @param string $token
     * @param string $secret
     * 
     * @return array|false
     */
    function jwtDecode(string $token, string $secret)
    {
        $tokenInfos = explode('.', $token);

        if (count($tokenInfos) < 3) {
            return false;
        }

        [$encodedHeader, $encodedPayload, $encodedSignature] = $tokenInfos;
        $originalPayload = json_decode(base64_decode($encodedPayload), true);

        if (!isset($originalPayload['exp']) || $originalPayload['exp'] <= time()) {
            return false;
        }

        $signature = base64UrlEncode(hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $secret));

        if ($encodedSignature !== $signature) {
            return false;
        }

        return $originalPayload;
    }
}

if (!function_exists('sanitizeInput')) {
    /**
     * 將 HTML 中的特殊字元做編碼處理
     * 
     * @param string $input
     * 
     * @return string
     */
    function sanitizeInput(string $input)
    {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}
