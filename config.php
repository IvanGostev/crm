<?php

function tt(mixed $value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
function tte(mixed $value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

// config.php

const Domain = 'crm';

const DB_HOST = 'localhost';
const DB_NAME = 'crm';
const DB_USER = 'root';
const DB_PASS = 'root';
const ENABLE_PERMISSION_CHECK = true;

