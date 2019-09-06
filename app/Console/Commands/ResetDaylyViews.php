<?php

namespace App\Console\Commands;

use App\Advert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetDaylyViews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset_advert:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset daily views';
    private $advert = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->advert = DB::table('advert')->update(['views_day'=> '0']);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
