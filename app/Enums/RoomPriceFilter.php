<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoomPriceFilter extends Enum
{
    const Lessthan50 = [1, 50];
    const About50To100 = [50, 100];
    const About100To200 = [100, 200];
    const GretherThan200 = [200, 99999];
}
