<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use App\Models\RsvHopeTime;
use Carbon\Carbon;

class RsvTimePassed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rsv:pass';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Reservation::where('status', '20')
            ->where(function($subquery) {
                $subquery->whereDate('visit_date', '<', Carbon::now())
                    ->orWhere(function($subquery1) {
                        $subquery1->whereDate('visit_date', Carbon::now())
                            ->whereTime('start_time', '<=', Carbon::now());
                    });
            })
            ->update(['status' => '25']);
    }
}
