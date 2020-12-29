<?php

/**
 * Функция __autoload для автоматического подключения классов
 * @param $class_name
 */
function Autoload($class_name)
{
    // Массив папок, в которых могут находиться необходимые классы
    $array_paths = [
        '/models/',
        '/components/',
        '/controllers/'
    ];

    // Проходим по массиву папок
    foreach ($array_paths as $path) {

        // Формируем имя и путь к файлу с классом
        $path = ROOT . $path . $class_name . '.php';

        // Если такой файл существует, подключаем его
        if (is_file($path)) {
            include_once $path;
        }
    }
}