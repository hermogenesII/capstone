<?php

// spl_autoload_register('myAutoloader');

// function myAutoloader($classname)
// {
//     $path = "classes";
//     $extention = ".class.php";
//     $fullPath = $path . $classname . $extention;

//     if (file_exists($fullPath)) {
//         return false;
//     }

//     include_once $fullPath;
// }

spl_autoload_register(function ($classname) {
    $file = __DIR__ . '\\' . $classname . '.class.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

    if (file_exists($file)) {
        include $file;
    }
});
