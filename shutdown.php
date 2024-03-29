<?php

use Database\DB;

register_shutdown_function(function () {
    DB::disconnect();
});
