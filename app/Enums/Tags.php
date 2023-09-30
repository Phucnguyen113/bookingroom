<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Tags extends Enum
{
    const RoomService = [
        'general_amenities' => 'room_service_general_amenities',
        'outdoor_facilities' => 'room_service_outdoor_facilities',
    ];

    const Blog = 'blog-tag';
}
