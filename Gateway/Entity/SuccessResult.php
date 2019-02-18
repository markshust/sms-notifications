<?php
/**
 * LINK Mobility SMS Notifications
 *
 * Sends transactional SMS notifications through the LINK Mobility messaging
 * service.
 *
 * @package LinkMobility\SMSNotifications\Gateway\Entity
 * @author Joseph Leedy <joseph@wagento.com>
 * @author Yair García Torres <yair.garcia@wagento.com>
 * @copyright Copyright (c) LINK Mobility (https://www.linkmobility.com/)
 * @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */

declare(strict_types=1);

namespace LinkMobility\SMSNotifications\Gateway\Entity;

/**
 * Success Result Entity
 *
 * @package LinkMobility\SMSNotifications\Gateway\Entity
 * @author Joseph Leedy <joseph@wagento.com>
 */
final class SuccessResult implements SuccessResultInterface
{
    private const TYPE = 'success';

    private $messageId = '';
    private $resultCode = 0;
    private $description = '';
    private $smsCount = 0;

    public function __construct(array $data = [])
    {
        if (array_key_exists('messageId', $data)) {
            $this->setMessageId($data['messageId']);
        }

        if (array_key_exists('resultCode', $data)) {
            $this->setResultCode($data['resultCode']);
        }

        if (array_key_exists('description', $data)) {
            $this->setDescription($data['description']);
        }
    }

    public function setMessageId(string $messageId): void
    {
        $this->messageId = $messageId;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function setResultCode(int $resultCode): void
    {
        $this->resultCode = $resultCode;
    }

    public function getResultCode(): int
    {
        return $this->resultCode;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setSmsCount(int $smsCount): void
    {
        $this->smsCount = $smsCount;
    }

    public function getSmsCount(): int
    {
        return $this->smsCount;
    }

    public function getType(): string
    {
        return self::TYPE;
    }

    public function getCode(): int
    {
        return $this->getResultCode();
    }

    public function getMessage(): string
    {
        return implode(': ', [$this->getResultCode(), $this->getDescription()]);
    }

    public function toArray(): array
    {
        return [
            'messageId' => $this->messageId,
            'resultCode' => $this->resultCode,
            'description' => $this->description,
            'smsCount' => $this->smsCount
        ];
    }
}
