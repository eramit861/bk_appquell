<?php

// Auto-load all helper classes globally
// This file makes helper classes available without namespace

if (!class_exists('Helper')) {
    class_alias('App\Helpers\Helper', 'Helper');
}

if (!class_exists('AuthHelper')) {
    class_alias('App\Helpers\AuthHelper', 'AuthHelper');
}

if (!class_exists('ClientHelper')) {
    class_alias('App\Helpers\ClientHelper', 'ClientHelper');
}

if (!class_exists('AdminHelper')) {
    class_alias('App\Helpers\AdminHelper', 'AdminHelper');
}

if (!class_exists('AddressHelper')) {
    class_alias('App\Helpers\AddressHelper', 'AddressHelper');
}

if (!class_exists('ArrayHelper')) {
    class_alias('App\Helpers\ArrayHelper', 'ArrayHelper');
}

if (!class_exists('DateTimeHelper')) {
    class_alias('App\Helpers\DateTimeHelper', 'DateTimeHelper');
}

if (!class_exists('DocumentHelper')) {
    class_alias('App\Helpers\DocumentHelper', 'DocumentHelper');
}

if (!class_exists('LocalFormHelper')) {
    class_alias('App\Helpers\LocalFormHelper', 'LocalFormHelper');
}

if (!class_exists('UtilityHelper')) {
    class_alias('App\Helpers\UtilityHelper', 'UtilityHelper');
}

if (!class_exists('ValidateHelper')) {
    class_alias('App\Helpers\ValidateHelper', 'ValidateHelper');
}

if (!class_exists('VideoHelper')) {
    class_alias('App\Helpers\VideoHelper', 'VideoHelper');
}

if (!class_exists('CurlHelper')) {
    class_alias('App\Helpers\CurlHelper', 'CurlHelper');
}

