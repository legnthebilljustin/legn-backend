<?php

namespace App\Services;

use Carbon\Carbon;
use InvalidArgumentException;

class DateService
{
    private $month;
    private $day;
    private $year;
    private $generatedDate;

    public function __construct(int $month, int $day, int $year)
    {
        $this->validateDate($month, $day, $year);

        $this->month = $month;
        $this->day = $day;
        $this->year = $year;
    }

    public function generateDate()
    {
        $date = Carbon::create($this->year, $this->month, $this->day);
        $this->generatedDate = $date;

        return $date;
    }

    public function generateDueDate()
    {
        return $this->generatedDate->copy()->addDays(20);
    }

    public function generateLastMonthBillingDate()
    {
        return $this->generatedDate->copy()->subMonth();
    }

    private function validateDate(int $month, int $day, int $year): void
    {
        if ($month < 1 || $month > 12) {
            throw new InvalidArgumentException('Month should be a numeric value from 1 to 12.');
        }

        if ($day < 1 || $day > 31) {
            throw new InvalidArgumentException('Day should be a numeric value from 1 to 31.');
        }

        if ($year < 1900 || $year > Carbon::now()->year) {
            throw new InvalidArgumentException('Yeaer must be a valid numeric value.');
        }
    }
}