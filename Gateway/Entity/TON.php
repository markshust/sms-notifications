<?php
/**
 * LINK Mobility SMS Notifications
 *
 * Sends transactional SMS notifications through the LINK Mobility messaging
 * service.
 *
 * @package Linkmobility\Notifications\Gateway\Entity
 * @author Joseph Leedy <joseph@wagento.com>
 * @author Yair García Torres <yair.garcia@wagento.com>
 * @copyright Copyright (c) LINK Mobility (https://www.linkmobility.com/)
 * @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */
declare(strict_types=1);

namespace Linkmobility\Notifications\Gateway\Entity;

use MyCLabs\Enum\Enum;

/**
 * TON (Type of Number) Entity
 *
 * @package Linkmobility\Notifications\Gateway\Entity
 */
class TON extends Enum
{
    /**
     * Short number; 1-14 digits depending on country.
     */
    public const SHORTNUMBER = 'SHORTNUMBER';
    /**
     * Up to 11 valid GSM characters in the range a-z, A-Z, 0-9.
     */
    public const ALPHANUMERIC = 'ALPHANUMERIC';
    /**
     * Mobile number in international format beginning with a + (i.e. +1-555-555-1234)
     */
    public const MSISDN = 'MSISDN';
}