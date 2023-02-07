<?php

namespace webdna\commerce\advancedpromotions\behaviors;

use craft\commerce\elements\Order;
use craft\commerce\Plugin as Commerce;
use craft\events\ModelEvent;
use craft\helpers\ArrayHelper;
use webdna\commerce\advancedpromotions\records\CouponCode;
use RuntimeException;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

/**
 * Order behavior.
 *
 * @property-read array $couponCodes
 */
class OrderBehavior extends Behavior
{
	/**
	 * @inheritdoc
	 */
	public function attach($owner)
	{
		if (!$owner instanceof Order) {
			throw new RuntimeException('OrderBehavior can only be attached to an Order element');
		}

		parent::attach($owner);
	}

	/**
	 * @return array
	 * @throws InvalidConfigException
	 */
	public function getCouponCodes(): array
	{
		return CouponCode::find(['orderId' => $this->owner->id])->select('code')->column();
	}
}