<?php

namespace App\Console\Commands;

use App\Advert;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TopAdvert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top_advert:4clock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Top Advert';
    private $top = null;
    private $advert = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $status = Advert::where('view_status',3)->get();

        if($status)
        {

            foreach ($status as $item)
            {
                $status = Advert::find($item->id);
                $status->view_status = null;
                $status->save();
            }

        }

        $top = DB::table('advert')->where('show',1)->orderBy('views_day','desc')->first();

        $top = Advert::find($top->id);
        $top->view_status = '3';
        $top->save();


        //$this->top = DB::table('advert')->orderBy('views_day','DESC')->first();
        //$this->top = DB::table('advert')->where('id',$this->top->id)->update(['view_status'=> '3']);
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
