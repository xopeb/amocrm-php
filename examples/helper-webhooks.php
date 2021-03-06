<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $listener = new \AmoCRM\Webhooks\Listener();

    // Добавление обработчка на уведомление contacts->add
    $listener->on('add_contact', function ($domain, $id, $data) {
        // $domain Поддомен amoCRM
        // $id Id объекта связаного с уведомленим
        // $data Поля возвращаемые уведомлением
        print_r($domain);
        print_r($id);
        print_r($data);
    });

    // Добавление обработчка на несколько уведомлений
    $listener->on(['update_contact', 'update_company'], function ($domain, $id, $data) {
        // $domain Поддомен amoCRM
        // $id Id объекта связаного с уведомленим
        // $data Поля возвращаемые уведомлением
        print_r($domain);
        print_r($id);
        print_r($data);
    });

    // Добавление обработчка как метод класса
    $listener->on('delete_company', ['Callbacks', 'event']);

    // Вызов обработчика уведомлений
    $listener->listen();

} catch (\AmoCRM\Exception $e) {
    printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}

class Callbacks
{
    public static function event($domain, $id, $data)
    {
        echo 'Fired ' . __METHOD__;
        print_r($domain);
        print_r($id);
        print_r($data);
        // $domain Поддомен amoCRM
        // $id Id объекта связаного с уведомленим
        // $data Поля возвращаемые уведомлением
    }
}
