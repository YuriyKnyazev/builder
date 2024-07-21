<?php

namespace App\Enums;

enum EventTypeEnum: int
{
    case CREATED = 1;
    case UPDATED = 2;
    case DELETED = 3;

    public function icon(): string
    {
        return match ($this) {
            self::CREATED => 'fa-plus',
            self::UPDATED => 'fa-save',
            self::DELETED => 'fa-trash',
        };
    }
    public function iconColor(): string
    {
        return match ($this) {
            self::CREATED => 'primary',
            self::UPDATED => 'warning',
            self::DELETED => 'danger',
        };
    }
}
