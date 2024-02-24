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
    const LessThan50 = [1, 50];
    const About50To100 = [50, 100];
    const About100To200 = [100, 200];
    const About200To500 = [200, 500];
    const About500To1000 = [500, 1000];
    const GreaterThan1000 = [1000, 99999];
}
