<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MediaCollection extends Enum
{
    const BlogThumbnail = 'blogs-thumbnail';

    const RoomThumbnail = 'rooms-thumbnail';
    const RoomImages = 'rooms-images';

    const MetaLogo = 'meta-logo';
    const MetaSlides = 'meta-slides';
}
