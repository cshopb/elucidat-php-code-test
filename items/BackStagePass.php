<?php

namespace Items;

class BackStagePass extends Item
{


	public function adjustQuality()
	{
		if ($this->sellIn < 0) {
			$this->quality = $this->minQuality;
		} elseif ($this->sellIn <= 5) {
			$this->quality += $this->qualityChangeProgress * 3;
		} elseif ($this->sellIn < 10) {
			$this->quality += $this->qualityChangeProgress * 2;
		} else {
			$this->quality += $this->qualityChangeProgress;
		}

		$this->checkQualityLimits();
	}


}