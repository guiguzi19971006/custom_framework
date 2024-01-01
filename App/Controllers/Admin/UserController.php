<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use Exception;

class UserController extends Controller
{
    /**
     * 所有管理者頁
     * 
     * @return void
     * @throws \Exception
     */
    public function index(): void
    {
        try {
            echo '456';
        } catch (Exception $e) {
            throw $e;
        }
    }
}
