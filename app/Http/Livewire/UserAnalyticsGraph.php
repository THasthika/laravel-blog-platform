<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UserAnalyticsGraph extends Component
{
    private static int $HOURLY_HOURS = 24;
    private static int $DAILY_DAYS = 10;
    private static int $MONTHLY_MONTHS = 12;

    public User $user;

    public string $selectedViewRange = 'hourly';

    public $labels = [];
    public $values = [];

    public array $viewRanges = [
        'hourly' => 'Hourly',
        'daily' => 'Daily',
        'monthly' => 'Monthly'
    ];

    private function createHourlyLabels()
    {
        $labels = [];
        $d = new \DateTime();

        for ($i = 0; $i < self::$HOURLY_HOURS; $i++) {
            $h = $d->format('H');
            $labels[] = $h.":00";
            $d = $d->sub(new \DateInterval('PT1H'));
        }

        return array_reverse($labels);
    }

    public function createDailyLabels()
    {
        $labels = [];
        $d = new \DateTime();

        for ($i = 0; $i < self::$DAILY_DAYS; $i++) {
            $l = $d->format('d/m');
            $labels[] = $l;
            $d = $d->sub(new \DateInterval('P1D'));
        }

        return array_reverse($labels);
    }

    public function createMonthlyLabels()
    {
        $labels = [];
        $d = new \DateTime();

        for ($i = 0; $i < self::$MONTHLY_MONTHS; $i++) {
            $l = $d->format('m/Y');
            $labels[] = $l;
            $d = $d->sub(new \DateInterval('P1M'));
        }

        return array_reverse($labels);
    }

    private function createHourlyValues()
    {
        // views
        $views = DB::query()->selectRaw('HOUR(pv.created_at) as hour, COUNT(*) as count')
            ->fromRaw('post_views pv')
            ->leftJoin('posts AS p', 'p.id', 'pv.post_id')
            ->whereRaw('pv.created_at >= now() - INTERVAL 1 DAY and p.user_id = :user_id', [$this->user->id])
            ->groupByRaw('HOUR(pv.created_at)')->get();

        $assocArr = [];

        foreach ($views as $e) {
            $assocArr[$e->hour] = $e->count;
        }

        $d = new \DateTime();
        $values = [];

        for ($i = 0; $i < self::$HOURLY_HOURS; $i++) {
            $h = $d->format('H');
            if (key_exists($h, $assocArr)) {
                $values[] = $assocArr[$h];
            } else {
                $values[] = 0;
            }
            $d = $d->sub(new \DateInterval('PT1H'));
        }

        return ['views' => array_reverse($values)];
    }

    private function createDailyValues()
    {
        // views
        $views = DB::query()->selectRaw('DAY(pv.created_at) as day, MONTH(pv.created_at) as month, COUNT(*) as count')
            ->fromRaw('post_views pv')
            ->leftJoin('posts AS p', 'p.id', 'pv.post_id')
            ->whereRaw('pv.created_at >= now() - INTERVAL :days DAY and p.user_id = :user_id', [self::$DAILY_DAYS, $this->user->id])
            ->groupByRaw('DAY(pv.created_at), MONTH(pv.created_at)')->get();

        $assocArr = [];

        foreach ($views as $e) {
            $assocArr[$e->day . "/" . str_pad($e->month, 2, "0", STR_PAD_LEFT)] = $e->count;
        }

        $d = new \DateTime();
        $values = [];

        for ($i = 0; $i < self::$DAILY_DAYS; $i++) {
            $h = $d->format('d/m');
            if (key_exists($h, $assocArr)) {
                $values[] = $assocArr[$h];
            } else {
                $values[] = 0;
            }
            $d = $d->sub(new \DateInterval('P1D'));
        }

        return ['views' => array_reverse($values)];
    }

    private function createMonthlyValues()
    {
        // views
        $views = DB::query()->selectRaw('MONTH(pv.created_at) as month, YEAR(pv.created_at) as year, COUNT(*) as count')
            ->fromRaw('post_views pv')
            ->leftJoin('posts AS p', 'p.id', 'pv.post_id')
            ->whereRaw('pv.created_at >= now() - INTERVAL :months MONTH and p.user_id = :user_id', [self::$MONTHLY_MONTHS, $this->user->id])
            ->groupByRaw('MONTH(pv.created_at), YEAR(pv.created_at)')->get();

        $assocArr = [];

        foreach ($views as $e) {
            $assocArr[str_pad($e->month, 2, "0", STR_PAD_LEFT) . "/" . $e->year] = $e->count;
        }

        $d = new \DateTime();
        $values = [];

        for ($i = 0; $i < self::$MONTHLY_MONTHS; $i++) {
            $h = $d->format('m/Y');
            if (key_exists($h, $assocArr)) {
                $values[] = $assocArr[$h];
            } else {
                $values[] = 0;
            }
            $d = $d->sub(new \DateInterval('P1M'));
        }

        return ['views' => array_reverse($values)];
    }

    public function mount() {
        $this->labels = $this->computeLabels();
        $this->values = $this->computeValues();
        $this->emit('view-range-changed');
    }

    public function updatedSelectedViewRange() {
        $this->labels = $this->computeLabels();
        $this->values = $this->computeValues();
        $this->emit('view-range-changed');
    }

    private function computeLabels() {
        return match ($this->selectedViewRange) {
            'hourly' => $this->createHourlyLabels(),
            'daily' => $this->createDailyLabels(),
            'monthly' => $this->createMonthlyLabels(),
            default => [],
        };
    }

    private function computeValues() {
        return match ($this->selectedViewRange) {
            'hourly' => $this->createHourlyValues(),
            'daily' => $this->createDailyValues(),
            'monthly' => $this->createMonthlyValues(),
            default => [
                'views' => [],
            ],
        };
    }

    public function render()
    {
        return view('livewire.user-analytics-graph', [
            'viewRanges' => $this->viewRanges
        ]);
    }
}
