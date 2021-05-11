<?php


namespace App\Contracts;

/**
 * Class AlertFlashService
 *
 */
interface AlertFlashService
{
    /**
     * Добавить в сессию текст flash-сообщения для отображения в компоненте alert.
     *
     * @param  string  $message
     * @return AlertFlashService
     */
    public function message(string $message);

    /**
     * Добавить в сессию текст flash-сообщения с использование языковых файлов.
     *
     * @param  string  $key
     * @param array $values
     * @return AlertFlashService
     */
    public function lang(string $key, array $values = []);

    /**
     * Добавить в сессию danger тип flash-сообщения для отображения в компоненте alert.
     *
     * @return AlertFlashService
     */
    public function danger();

    /**
     * Добавить в сессию warning тип flash-сообщения для отображения в компоненте alert.
     *
     * @return AlertFlashService
     */
    public function warning();

    /**
     * Добавить в сессию success тип flash-сообщения для отображения в компоненте alert.
     *
     * @return AlertFlashService
     */
    public function success();

    /**
     * Добавить в сессию info тип flash-сообщения для отображения в компоненте alert.
     *
     * @return AlertFlashService
     */
    public function info();
}
