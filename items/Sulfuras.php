<?php

namespace Items;

class Sulfuras extends Item
{

	/**
	 * {@inheritdoc}
	 */
	protected $maxQuality = 80;


	public function nextDay()
	{
		$this->checkQualityLimits();
	}

}