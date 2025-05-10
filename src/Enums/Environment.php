<?php

namespace DazzaDev\ShipsGo\Enums;

enum Environment: string
{
    case Production = 'production';
    case Testing = 'testing';

    /**
     * Return the base URL associated with the environment.
     */
    public function baseUrl(): string
    {
        return match ($this) {
            self::Production => 'https://api.shipsgo.com/v2/',
            self::Testing => 'https://api.shipsgo.com/v2/',
        };
    }
}
