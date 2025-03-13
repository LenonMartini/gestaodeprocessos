<?php

namespace App\Enums;

class StatusEnum
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';


    /**
     * Obter todas as opções de status.
     *
     * @return array
     */
    public static function getAllStatuses(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,

        ];
    }

    /**
     * Obter o nome legível de um status.
     *
     * @param string $status
     * @return string
     */
    public static function getStatusName(string $status): string
    {
        switch ($status) {
            case self::ACTIVE:
                return 'active';
            case self::INACTIVE:
                return 'inactive';
            default:
                return 'Desconhecido';
        }
    }
}
