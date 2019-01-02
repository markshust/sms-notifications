<?php
/**
 * LINK Mobility SMS Notifications
 *
 * Sends transactional SMS notifications through the LINK Mobility messaging
 * service.
 *
 * @package Linkmobility\Notifications\Test\Unit\Model
 * @author Joseph Leedy <joseph@wagento.com>
 * @author Yair García Torres <yair.garcia@wagento.com>
 * @copyright Copyright (c) LINK Mobility (https://www.linkmobility.com/)
 * @license https://opensource.org/licenses/OSL-3.0.php Open Software License 3.0
 */
declare(strict_types=1);

namespace Linkmobility\Notifications\Test\Unit\Model;

use Linkmobility\Notifications\Model\SmsSubscription;
use Linkmobility\Notifications\Model\SmsSubscriptionValidationRules;
use Linkmobility\Notifications\Model\SmsSubscriptionValidator;
use Linkmobility\Notifications\Model\Source\SmsType;
use Magento\Framework\Validator\DataObject;
use Magento\Framework\Validator\DataObjectFactory;
use Magento\Framework\Validator\NotEmpty;
use Magento\Framework\Validator\NotEmptyFactory;
use PHPUnit\Framework\TestCase;

/**
 * SMS Subscription Validator Test
 *
 * @package Linkmobility\Notifications\Test\Unit\Model
 * @author Joseph Leedy <joseph@wagento.com>
 */
class SmsSubscriptionValidatorTest extends TestCase
{
    /** @var \Linkmobility\Notifications\Model\SmsSubscriptionValidator */
    private $validator;

    public function testValidateValidSubscription()
    {
        $smsSubscription = $this->getMockBuilder(SmsSubscription::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'getCustomerId',
                'getSmsType',
            ])
            ->getMock();

        $smsSubscription->method('getCustomerId')->willReturn('1');
        $smsSubscription->method('getSmsType')->willReturn('order_placed');

        $this->validator->validate($smsSubscription);

        $this->assertTrue($this->validator->isValid());
        $this->assertEmpty($this->validator->getMessages());
    }

    public function testValidateInvalidSubscription()
    {
        $smsSubscription = $this->getMockBuilder(SmsSubscription::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator->validate($smsSubscription);

        $this->assertFalse($this->validator->isValid());
        $this->assertNotEmpty($this->validator->getMessages());
    }

    public function testGetValidator()
    {
        $this->assertInstanceOf(\Zend_Validate_Interface::class, $this->validator->getValidator());
    }

    protected function setUp()
    {
        parent::setUp();

        $validatorObjectFactory = $this->getMockBuilder(DataObjectFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $notEmptyFactory = $this->getMockBuilder(NotEmptyFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $inArrayFactory = $this->getMockBuilder(\Zend_Validate_InArrayFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $validatorObjectFactory->method('create')->willReturn(new DataObject());
        $notEmptyFactory->method('create')->willReturn(new NotEmpty());
        $inArrayFactory->method('create')->willReturnCallback(function ($arguments) {
            return new \Zend_Validate_InArray($arguments['options']);
        });

        $validationRules = new SmsSubscriptionValidationRules($notEmptyFactory, $inArrayFactory, new SmsType());
        $this->validator = new SmsSubscriptionValidator($validatorObjectFactory, $validationRules);
    }
}
