<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoomType extends Enum
{
    const Apartments = 0;
    const ServicedApartments = 1;
    const Houses = 2;
    const Villas = 3;
    const Studio = 4;
}
