<?php

use App\Supports\DB;

register_shutdown_function(function () {
    DB::disconnect();
});
