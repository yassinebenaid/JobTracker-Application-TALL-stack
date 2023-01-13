<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class Stats
{
    private array $stats = [];
    private string $last;

    public function __construct(
        protected Builder|Model $query
    ) {
    }

    /**
     * get the total of the given model
     *
     * @param boolean $save_state
     * @return int total records
     */
    public function total()
    {
        $this->stats['total'] = $this->builder()->count();

        return $this->getNumber('total');
    }

    /**
     * get the total records in last month
     *
     * @param boolean $save_state
     * @return int total records in last month
     */
    public function lastMonth()
    {
        $this->stats["last_month"] = $this->builder()
            ->whereDate("created_at", now()->subMonth())
            ->count();

        return $this->getNumber("last_month");
    }

    /**
     * get total records in the last given months
     *
     * @param integer $months
     * @return int total records in given last months
     */
    public function lastMonths(int $months)
    {
        $this->stats["last_{$months}_months"] =  $this->builder()
            ->whereDate("created_at", now()->subMonths($months))
            ->count();

        return $this->getNumber("last_{$months}_months");
    }

    /**
     * get total records in this year grouped by month
     *
     * @return \Illuminate\Support\Collection
     */
    public function thisYearByMonth()
    {
        return $this->builder()->selectRaw('MONTH(created_at) as month')
            ->selectRaw('count(*) as total')
            ->groupBy('month')
            ->whereRaw("YEAR(created_at) >= YEAR(CURRENT_TIMESTAMP)")
            ->get()->pluck("total")->toArray();
    }

    /**
     * get the total records in last year
     *
     * @param boolean $save_state
     * @return void total records in last year
     */
    public function lastYear()
    {
        $this->stats['last_year'] = $this->builder()
            ->whereDate("created_at", now()->subYear())
            ->count();

        return $this->getNumber("last_year");
    }

    /**
     * get the total records in last given years
     *
     * @param integer $years
     * @param boolean $save_state
     * @return int total records in given last years
     */
    public function lastYears(int $years,)
    {
        $this->stats["last_{$years}_years"] = $this->builder()
            ->whereDate("created_at", now()->subYears($years))
            ->count();

        return $this->getNumber("last_{$years}_years");
    }

    /**
     * determine wether the current total is more than total in last month
     *
     * @return bool
     */
    public function wasIncreased()
    {
        if (!isset($this->stats['total'])) $this->total();

        if (!isset($this->stats['last_month'])) $this->lastMonth();

        return $this->stats['total'] > $this->stats['last_month'];
    }

    public function improvement()
    {
        if (!isset($this->stats['total'])) $this->total();

        if (!isset($this->stats['last_month'])) $this->lastMonth();

        return $this->getNumber($this->stats['total'] - $this->stats['last_month']);
    }

    /**
     * return the needed number
     *
     * @param string $number
     * @param boolean $shorten
     * @return integer|float|string
     */
    protected function getNumber(string|int $number, bool $shorten = true): int|float|string
    {
        if (is_numeric($number))
            return match ($shorten) {
                true => shortenNumber($number),
                false => $number
            };


        return match ($shorten) {
            true => shortenNumber($this->stats[$number]),
            false => $this->stats[$number]
        };
    }


    /**
     * to avoid conflict between queries, we get only copy of the query
     *
     *  @return Builder|Model
     */
    private function builder()
    {
        return clone $this->query;
    }
}
