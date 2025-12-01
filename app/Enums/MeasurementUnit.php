<?php

namespace App\Enums;

enum MeasurementUnit: string
{
    case KG = 'kg';
    case M2 = 'm²';
    case M3 = 'm³';
    case UNIDAD = 'Unidad';
    case LITRO = 'Litro';
    case HORA = 'Hora';
    case MINUTO = 'Minuto';
    case SEGUNDO = 'Segundo';
    case TONELADA = 'Tonelada';
    case CM = 'cm';
    case MM = 'mm';
    case KM = 'km';
    case PIEZA = 'pz';

    public static function options(): array
    {
        return array_map(fn ($unit) => $unit->value, self::cases());
    }
}
