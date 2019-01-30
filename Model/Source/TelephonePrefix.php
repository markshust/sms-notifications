<?php
/**
 * LINK Mobility SMS Notifications
 *
 * Sends transactional SMS notifications through the LINK Mobility messaging
 * service.
 *
 * @package Linkmobility\Notifications\Model\Source
 * @author Joseph Leedy <joseph@wagento.com>
 * @author Yair García Torres <yair.garcia@wagento.com>
 * @copyright Copyright (c) LINK Mobility (https://www.linkmobility.com/)
 * @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */

declare(strict_types=1);

namespace Linkmobility\Notifications\Model\Source;

use Linkmobility\Notifications\Model\ResourceModel\TelephonePrefix\CollectionFactory as TelephonePrefixCollectionFactory;
use Magento\Framework\Data\Collection;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Telephone Prefix Source Model
 *
 * @package Linkmobility\Notifications\Model\Source
 * @author Joseph Leedy <joseph@wagento.com>
 */
final class TelephonePrefix implements OptionSourceInterface
{
    /**
     * @var \Linkmobility\Notifications\Model\ResourceModel\TelephonePrefix\CollectionFactory
     */
    private $prefixCollectionFactory;

    public function __construct(TelephonePrefixCollectionFactory $prefixCollectionFactory)
    {
        $this->prefixCollectionFactory = $prefixCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray(): array
    {
        $prefixes = $this->prefixCollectionFactory->create()
            ->setOrder('country_name', Collection::SORT_ORDER_ASC)
            ->load()
            ->getItems();
        $options = [];

        /** @var \Linkmobility\Notifications\Model\TelephonePrefix $prefix */
        foreach ($prefixes as $prefix) {
            $options[] = [
                'value' => $prefix->getCountryCode() . '_' . $prefix->getPrefix(),
                'label' => $prefix->getCountryName() . ' (+' . $prefix->getPrefix() . ')'
            ];
        }

        return $options;
    }
}
