<?php

/*
 * This file is part of Laravel Eloquent Flag.
 *
 * (c) CyberCog <support@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\Flag\Traits\Inverse;

/**
 * Class HasExpiredFlag.
 *
 * @package Cog\Flag\Traits\Inverse
 */
trait HasExpiredFlag
{
    use HasExpiredFlagHelpers,
        HasExpiredFlagScope;
}
