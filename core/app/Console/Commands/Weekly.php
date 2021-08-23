<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

class Weekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:weekly';

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
        $users = DB::table('users')->where('plan_id',"!=", 0)->get();
            
            foreach($users as $user){
                $com = DB::table('plan_purchases')->where('user_id', "=", $user->id)->get();
                foreach($com as $co){
                    if($co->comission_type == 'weekly'){
                        
                        $comission = DB::table('plans')->where('id',$co->plan_id)->first();
                        $comm = $comission->weekly_com;
                        $update = DB::table('users')->where('id', "=", $user->id)->update([
                            'balance' => $user->balance + (($co->amount/100)*$comm),
                            'total_commission' => $user->total_commission + (($co->amount/100)*$comm)
                            ]);
                        
                        $add =  DB::table('transactions')->insert([ 
                        'user_id' => $user->id,
                        'charge' => '',
                        'amount' => (($co->amount/100)*$comm),
                        'trx_type' => '+',
                        'details' => 'Weekly commission',
                        'remark' => 'plan_commission',
                        'trx' => getTrx(),
                        'post_balance' => $user->balance,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                } 
                }
            //     if($user->com_type == 'weekly'){
            //     $update = DB::table('users')->where('id', "=", $user->id)->update([
            //         'balance' => $user->balance + ($com->weekly_com),
            //         'total_commission' => $user->total_commission + $com->weekly_com
            //         ]);
                
            //     $add =  DB::table('transactions')->insert([ 
            //     'user_id' => $user->id,
            //     'charge' => '',
            //     'amount' => ($com->weekly_com),
            //     'trx_type' => '+',
            //     'details' => 'Weekly commission',
            //     'remark' => 'plan_commission',
            //     'trx' => getTrx(),
            //     'post_balance' => $user->balance,
            //     'created_at' => date('Y-m-d H:i:s')
            // ]);
            //     }
                
            }
    }
}
