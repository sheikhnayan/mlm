<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Transaction;

use Illuminate\Support\Facades\DB;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
                if( $co->comission_type == 'daily'){
                    $comission = DB::table('plans')->where('id',$co->plan_id)->first();
                    $comm = $comission->daily_com;
                    $update = DB::table('users')->where('id', "=", $user->id)->update([
                        'balance' => $user->balance + (($co->amount/100)*$comm),
                        'total_commission' => $user->total_commission + (($co->amount/100)*$comm)
                    ]);
                        
                    $add =  DB::table('transactions')->insert([ 
                    'user_id' => $user->id,
                    'charge' => '',
                    'amount' => (($co->amount/100)*$comm),
                    'trx_type' => '+',
                    'details' => 'Daily commission',
                    'remark' => 'plan_commission',
                    'trx' => getTrx(),
                    'post_balance' => $user->balance,
                    'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
                }
            //     if( $user->com_type == 'daily'){
            //     $update = DB::table('users')->where('id', "=", $user->id)->update([
            //         'balance' => $user->balance + $com->daily_com,
            //         'total_commission' => $user->total_commission + $com->daily_com
            //         ]);
                    
            //     $add =  DB::table('transactions')->insert([ 
            //     'user_id' => $user->id,
            //     'charge' => '',
            //     'amount' => ($com->daily_com),
            //     'trx_type' => '+',
            //     'details' => 'Daily commission',
            //     'remark' => 'plan_commission',
            //     'trx' => getTrx(),
            //     'post_balance' => $user->balance,
            //     'created_at' => date('Y-m-d H:i:s')
            // ]);
            //     }
                
                
            }
    
        $ref = DB::table('users')->get();
        
        foreach($ref as $re){
            
            $ref_com = DB::table('users')->where('id',$re->id)->first();
            
            if($ref_com->ref_com_this_month >= 1000){
                
                
            // the message
            $msg = $ref_com->firstname." ".$ref_com->firstname."has achieved the goal for stage 1 referal commission. 
            Email: ".$ref_com->email."
            Username:".$ref_com->username;
            
            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);
            
            // send email
            mail("admin@safeworld1.com","Referral Stage Completed",$msg);
            
            
            $clear = DB::table('users')->where('id',$re->id)->update([
                'ref_com_this_month' => 0
                ]);
            }
            
            
            
        }
            
    }
}
