<?php

namespace Items;

abstract class Item extends \App\Item
{

	/**
	 * maxQuality
	 *
	 * @var int
	 */
	protected $maxQuality = 50;

	/**
	 * minQuality
	 *
	 * @var int
	 */
	protected $minQuality = 0;

	/**
	 * qualityChangeProgress
	 *
	 * @var int
	 */
	protected $qualityChangeProgress = 1;

	/**
	 * increaseInQuality
	 *
	 * @var bool
	 */
	protected $increaseInQuality = FALSE;


	/**
	 * Item constructor.
	 *
	 * @param $name
	 * @param $quality
	 * @param $sellIn
	 */
	public function __construct($name, $quality, $sellIn)
	{
		parent::__construct($name, $quality, $sellIn);
		$this->checkQualityLimits();

	}


	public function nextDay()
	{
		$this->adjustSellIn();
		$this->adjustQuality();

	}//end nextDay()


	/**
	 * Adjust Sell In
	 *
	 * @return void
	 */
	public function adjustSellIn()
	{
		--$this->sellIn;

	}//end adjustSellIn()


	/**
	 * Adjust Quality
	 *
	 * @return void
	 */
	public function adjustQuality()
	{
		$direction = -1;
		if ($this->increaseInQuality === TRUE) {
			$direction = 1;
		}

		if ($this->sellIn < 0) {
			$this->qualityChangeProgress *= 2;
		}

		$this->quality += $direction * $this->qualityChangeProgress;

		$this->checkQualityLimits();

	}//end adjustQuality()


	/**
	 * Check Quality Limits
	 *
	 * @return void
	 */
	protected function checkQualityLimits()
	{
		if ($this->quality < $this->minQuality) {
			$this->quality = $this->minQuality;
		} else if ($this->quality > $this->maxQuality) {
			$this->quality = $this->maxQuality;
		}

	}//end checkQualityLimits()


}