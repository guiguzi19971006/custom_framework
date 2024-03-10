<?php

namespace Database;

enum Transaction: string
{
    case TRANSACTION = 'transaction';
    case ROLLBACK = 'rollback';
    case COMMIT = 'commit';
}
