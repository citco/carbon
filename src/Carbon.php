<?php namespace Citco;

class Carbon extends \Carbon\Carbon {

	private function getDate($date)
	{
		if (is_string($date) || is_numeric($date))
		{
			return static::parse(strlen($date) > 4 ? $date : "{$date}-01-01");
		}
		else
		{
			return $date instanceof \Carbon\Carbon ? $date : $this;
		}
	}

	public function getNewYearBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$day_of_week = (new static)->parse("{$date->year}-01-01")->dayOfWeek;

		$new_year_bank_holiday = "{$date->year}-01-01";
		$day_of_week == 0 AND $new_year_bank_holiday = "{$date->year}-01-02";
		$day_of_week == 6 AND $new_year_bank_holiday = "{$date->year}-01-03";

		return $new_year_bank_holiday;
	}

	public function getGoodFridayBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$good_friday_bank_holiday = (new static)->parse("{$date->year}-03-21")->addDays(easter_days($date->year) - 2)->toDateString();

		return $good_friday_bank_holiday;
	}

	public function getEasterMondayBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$easter_monday_bank_holiday = (new static)->parse("{$date->year}-03-21")->addDays(easter_days($date->year) + 1)->toDateString();

		return $easter_monday_bank_holiday;
	}

	public function getEarlyMayBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		if (in_array($date->year, [1995, 2020]))
		{
			// Victory in Europe day
			return "{$date->year}-05-08";
		}

		$day_of_week = (new static)->parse("{$date->year}-05-01")->dayOfWeek;

		$day_of_week == 0 AND $early_may_bank_holiday = "{$date->year}-05-02";
		$day_of_week == 1 AND $early_may_bank_holiday = "{$date->year}-05-01";
		$day_of_week == 2 AND $early_may_bank_holiday = "{$date->year}-05-07";
		$day_of_week == 3 AND $early_may_bank_holiday = "{$date->year}-05-06";
		$day_of_week == 4 AND $early_may_bank_holiday = "{$date->year}-05-05";
		$day_of_week == 5 AND $early_may_bank_holiday = "{$date->year}-05-04";
		$day_of_week == 6 AND $early_may_bank_holiday = "{$date->year}-05-03";

		return $early_may_bank_holiday;
	}

	public function getSpringBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		if ($date->year == 2002)
		{
			// Moved for Golden Jubilee of Elizabeth II
			return '2002-06-04';
		}

		if ($date->year == 2012)
		{
			// Moved for Diamond Jubilee of Elizabeth II
			return '2012-06-04';
		}

		if ($date->year == 2022)
		{
			// Moved for Platinum Jubilee of Elizabeth II
			return '2022-06-02';
		}

		$day_of_week = (new static)->parse("{$date->year}-05-31")->dayOfWeek;

		$day_of_week == 0 AND $spring_bank_holiday = "{$date->year}-05-25";
		$day_of_week == 1 AND $spring_bank_holiday = "{$date->year}-05-31";
		$day_of_week == 2 AND $spring_bank_holiday = "{$date->year}-05-30";
		$day_of_week == 3 AND $spring_bank_holiday = "{$date->year}-05-29";
		$day_of_week == 4 AND $spring_bank_holiday = "{$date->year}-05-28";
		$day_of_week == 5 AND $spring_bank_holiday = "{$date->year}-05-27";
		$day_of_week == 6 AND $spring_bank_holiday = "{$date->year}-05-26";

		return $spring_bank_holiday;
	}

	public function getSummerBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$day_of_week = (new static)->parse("{$date->year}-08-31")->dayOfWeek;

		$day_of_week == 0 AND $summer_bank_holiday = "{$date->year}-08-25";
		$day_of_week == 1 AND $summer_bank_holiday = "{$date->year}-08-31";
		$day_of_week == 2 AND $summer_bank_holiday = "{$date->year}-08-30";
		$day_of_week == 3 AND $summer_bank_holiday = "{$date->year}-08-29";
		$day_of_week == 4 AND $summer_bank_holiday = "{$date->year}-08-28";
		$day_of_week == 5 AND $summer_bank_holiday = "{$date->year}-08-27";
		$day_of_week == 6 AND $summer_bank_holiday = "{$date->year}-08-26";

		return $summer_bank_holiday;
	}

	public function getChristmasBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$day_of_week = (new static)->parse("{$date->year}-12-25")->dayOfWeek;

		$christmas_bank_holiday = "{$date->year}-12-25";
		$day_of_week == 0 AND $christmas_bank_holiday = "{$date->year}-12-27";
		$day_of_week == 5 AND $christmas_bank_holiday = "{$date->year}-12-25";
		$day_of_week == 6 AND $christmas_bank_holiday = "{$date->year}-12-27";

		return $christmas_bank_holiday;
	}

	public function getBoxingDayBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$day_of_week = (new static)->parse("{$date->year}-12-25")->dayOfWeek;

		$boxing_day_bank_holiday = "{$date->year}-12-26";
		$day_of_week == 0 AND $boxing_day_bank_holiday = "{$date->year}-12-26";
		$day_of_week == 5 AND $boxing_day_bank_holiday = "{$date->year}-12-28";
		$day_of_week == 6 AND $boxing_day_bank_holiday = "{$date->year}-12-28";

		return $boxing_day_bank_holiday;
	}

	public function getBankHolidays($dates = null)
	{
		is_array($dates) OR $dates = [$dates];

		foreach ($dates as $index => $date)
		{
			$dates[$index] = $this->getDate($date);
		}

		$bank_holidays = [];

		foreach ($dates as $date)
		{
			$bank_holidays[$this->getNewYearBankHoliday($date)] = 'New Year\'s Day Holiday';
			$bank_holidays[$this->getGoodFridayBankHoliday($date)] = 'Good Friday';
			$bank_holidays[$this->getEasterMondayBankHoliday($date)] = 'Easter Monday';
			$bank_holidays[$this->getEarlyMayBankHoliday($date)] = 'Early May Bank Holiday';
			$bank_holidays[$this->getSpringBankHoliday($date)] = 'Spring Bank Holiday';
			$bank_holidays[$this->getSummerBankHoliday($date)] = 'Summer Bank Holiday';
			$bank_holidays[$this->getChristmasBankHoliday($date)] = 'Christmas Day Holiday';
			$bank_holidays[$this->getBoxingDayBankHoliday($date)] = 'Boxing Day';

			$date->year == 1999 AND $bank_holidays['1999-12-31'] = 'Millennium Eve';
			$date->year == 2002 AND $bank_holidays['2002-06-03'] = 'Golden Jubilee Holiday';
			$date->year == 2011 AND $bank_holidays['2011-04-29'] = 'Royal Wedding Bank Holiday';
			$date->year == 2012 AND $bank_holidays['2012-06-05'] = 'Diamond Jubilee Holiday';
			$date->year == 2022 AND $bank_holidays['2022-06-03'] = 'Platinum Jubilee Holiday';
			$date->year == 2022 AND $bank_holidays['2022-09-19'] = 'State Funeral of Queen Elizabeth II';
			$date->year == 2023 AND $bank_holidays['2023-05-08'] = 'Coronation of King Charles III';
		}

		ksort($bank_holidays);

		return $bank_holidays;
	}

	public function isBankHoliday($date = null)
	{
		$date = $this->getDate($date);

		$bank_holidays = $this->getBankHolidays($date);

		if (in_array($date->toDateString(), array_keys($bank_holidays)))
		{
			return $bank_holidays[$date->toDateString()];
		}

		return false;
	}

	public function nextBankHoliday($date = null)
	{
		return $this->nextBankHolidays(1, $date);
	}

	public function previousBankHoliday($date = null)
	{
		return $this->previousBankHolidays(1, $date);
	}

	public function nextBankHolidays($count = 1, $date = null)
	{
		$date = $this->getDate($date);

		$next_bank_holidays = [];

		$year = static::parse("First day of January {$date->year}");

		$bank_holidays = $this->getBankHolidays($year);

		while (count($next_bank_holidays) < $count)
		{
			foreach ($bank_holidays as $bank_holiday => $description)
			{
				if ($date->lt(static::parse($bank_holiday)))
				{
					if (count($next_bank_holidays) < $count)
					{
						$next_bank_holidays[$bank_holiday] = $description;
					}
				}
			}

			$bank_holidays = $this->getBankHolidays($year->addYear());
		}

		ksort($next_bank_holidays);

		return $next_bank_holidays;
	}

	public function previousBankHolidays($count = 1, $date = null)
	{
		$date = $this->getDate($date);

		$previous_bank_holidays = [];

		$year = static::parse("First day of January {$date->year}");

		$bank_holidays = array_reverse($this->getBankHolidays($year));

		while (count($previous_bank_holidays) < $count)
		{
			foreach ($bank_holidays as $bank_holiday => $description)
			{
				if ($date->gt(static::parse($bank_holiday)))
				{
					if (count($previous_bank_holidays) < $count)
					{
						$previous_bank_holidays[$bank_holiday] = $description;
					}
				}
			}

			$bank_holidays = array_reverse($this->getBankHolidays($year->subYear()));
		}

		ksort($previous_bank_holidays);

		return $previous_bank_holidays;
	}

	public function bankHolidaysSince($date)
	{
		$start = $this->getDate($date);
		$end = $this;

		if ($end->lt($start))
		{
			$temp = $end;
			$end = $start;
			$start = $temp;
		}

		$years = [];

		for ($i = $start->year; $i <= $end->year; $i++)
		{
			$years[] = $i;
		}

		$holidays = $this->getBankHolidays($years);

		foreach ($holidays as $date => $holiday)
		{
			if (! (new static($date))->between($start, $end))
			{
				unset($holidays[$date]);
			}
		}

		return $holidays;
	}
}
