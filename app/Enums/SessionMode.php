<?php

namespace App\Enums;

enum SessionMode: string
{
    case InPerson = 'in_person';
    case Online = 'online';
    case Hybrid = 'hybrid';

    public function label(): string
    {
        return match ($this) {
            self::InPerson => __('In person'),
            self::Online => __('Online'),
            self::Hybrid => __('Hybrid'),
        };
    }
}
