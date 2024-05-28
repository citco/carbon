# Carbon with support of UK Bank Holidays
This is a wrapper for [Carbon](https://github.com/briannesbitt/Carbon) which also calculates which days are British bank holidays (England &amp; Wales only).

<a name="install"></a>
## Installation

<a name="install-composer"></a>
### With Composer

```
$ composer require citco/carbon
```

```json
{
    "require": {
        "citco/carbon": "*"
    }
}
```

```php
<?php
require 'vendor/autoload.php';

use Citco\Carbon;

echo "Today is ", (new Carbon)->isBankHoliday() ?: "not bank holiday";
```

<a name="install-nocomposer"></a>
### Without Composer

Why are you not using [composer](http://getcomposer.org/)? Download [Carbon.php](https://github.com/citco/carbon/blob/master/src/Carbon.php) from the repo and save the file into your project path somewhere. (You also need to download [nesbot/carbon](https://github.com/briannesbitt/Carbon))

```php
<?php
require 'path/to/nesbot/Carbon.php';
require 'path/to/citco/Carbon.php';

use Citco\Carbon;

echo "Today is ", (new Carbon)->isBankHoliday() ?: "not bank holiday";
```

<a name="sample-code"></a>
### Sample code

Here are some samples on using this class:
```php
// Creates a new instance of the class
$c = new Carbon(); // Today's date
$c = new Carbon('2012-05-21'); // Date as string
$c = Carbon::parse('First day of May 2011');

// Checks if the given date is bank holiday
$boolean = $c->isBankHoliday('2016-05-21');
$boolean = $c->isBankHoliday(Carbon::parse('First day of 2000'));

// Returns array of holidays for the given year
$c->getBankHolidays(2015);
$c->getBankHolidays(array(2010, 2012));
$c->getBankHolidays(Carbon::now());

// Returns New Year date of the given year
$c->getNewYearBankHoliday(2012); // 2012-01-02

// Without any parameter will return date for the init year
$c->getNewYearBankHoliday();
$c->getGoodFridayBankHoliday();
$c->getEasterMondayBankHoliday();
$c->getEarlyMayBankHoliday();
$c->getSpringBankHoliday();
$c->getSummerBankHoliday();
$c->getBoxingDayBankHoliday();
$c->getChristmasBankHoliday();

// Returns next/previous bank holiday
$c->nextBankHoliday();
$c->previousBankHoliday();

$c->nextBankHoliday(Carbon::parse('Next year May 1st'));
$c->previousBankHoliday(Carbon::parse('Next year May 1st'));

// Returns N next/previous bank holidays
$n = 20;
$c->nextBankHolidays($n);
$c->previousBankHolidays($n);

$c->nextBankHolidays($n, Carbon::parse('Next year May 1st'));
$c->previousBankHolidays($n, Carbon::parse('Next year May 1st'));

// Returns the list of bank holidays between two dates
$start = Carbon::now();
$end = Carbon::now()->subYear(1);
$holidays = $start->bankHolidaysSince($end);
```

<a name="issues"></a>
### Issues
Bug reports and feature requests can be submitted on the [Github Issue Tracker](https://github.com/citco/carbon/issues).

<a name="requirements"></a>
### Requirements

PHP 8.1 or above (For older PHP versions, please use the version 1.x or 2.x of this package)

<a name="license"></a>
### License

Bank Holidays is licensed under the MIT License - see the LICENSE file for details
