<?php



/**
 * Skeleton subclass for representing a row from the 'product' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.datawrapper
 */
class Product extends BaseProduct
{
    const PERIOD_ONCE   = 'once';
    const PERIOD_DAYS   = 'day';
    const PERIOD_MONTHS = 'month';
    const PERIOD_YEARS  = 'year';

    public static $PERIODS = array(
        self::PERIOD_ONCE,
        self::PERIOD_DAYS,
        self::PERIOD_MONTHS,
        self::PERIOD_YEARS
    );

	public function hasPlugin(Plugin $plugin) {
		return ProductPluginQuery::create()
			->filterByProduct($this)
			->filterByPlugin($plugin)
			->count() > 0;
	}

    public function getData() {
        $data = parent::getData();
        if(is_string($data)) {
            $data = json_decode($data, true);
        }

        return $data;
    }

    public function isSubscription() {
        $data = $this->getData();
        return isset($data['period']) && $data['period'] !== self::PERIOD_ONCE;
    }
}
