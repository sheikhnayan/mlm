<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Transaction;
use App\Models\Royalty_Fund;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class Monthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:monthly';

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
                    if($co->comission_type == 'monthly'){
                    $comission = DB::table('plans')->where('id',$co->plan_id)->first();
                    $comm = $comission->monthly_com;
                    
                     $update = DB::table('users')->where('id', "=", $user->id)->update([
                    'balance' => $user->balance + (($co->amount/100)*$comm),
                    'total_commission' => $user->total_commission + (($co->amount/100)*$comm)
                    ]);
                
                $add =  DB::table('transactions')->insert([ 
                'user_id' => $user->id,
                'charge' => '',
                'amount' => (($co->amount/100)*$comm),
                'trx_type' => '+',
                'details' => 'Monthly commission',
                'remark' => 'plan_commission',
                'trx' => getTrx(),
                'post_balance' => $user->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
                }
                }
            //     if($user->com_type == 'monthly'){
            //     $update = DB::table('users')->where('id', "=", $user->id)->update([
            //         'balance' => $user->balance + ($com->monthly_com),
            //         'total_commission' => $user->total_commission + $com->monthly_com
            //         ]);
                
            //     $add =  DB::table('transactions')->insert([ 
            //     'user_id' => $user->id,
            //     'charge' => '',
            //     'amount' => ($com->monthly_com),
            //     'trx_type' => '+',
            //     'details' => 'Monthly commission',
            //     'remark' => 'plan_commission',
            //     'trx' => getTrx(),
            //     'post_balance' => $user->balance,
            //     'created_at' => date('Y-m-d H:i:s')
            // ]);
            //     }
                
            $clear = DB::table('users')->update([
                'ref_com_this_month' => 0
                ]);
                
            }
            
        $royal = DB::table('royalty__funds')->where('id',1)->first();
        $royal_amount = $royal->amount/7;
        
        $team_1 = DB::table('users')->where('ranks', 'team_leader_1')->get();
        
        $team_1_count = $team_1->count();
        
        if($team_1_count != 0){
        
        $team_1_amount = $royal_amount / $team_1_count;
        
        foreach($team_1 as $team1){
            $update = DB::table('users')->where('id', $team1->id)->update([
                'balance' => $team1->balance + $team_1_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $team1->id,
                'charge' => '',
                'amount' => $team_1_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $team1->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        }
        
        $team_2 = DB::table('users')->where('ranks', 'team_leader_2')->get();
        
        $team_2_count = $team_2->count();
        
        if($team_2_count != 0){
            
        $team_2_amount = $royal_amount / $team_2_count;
        
        $team_2_amount = $royal_amount / $team_2_count;
        
        foreach($team_2 as $team2){
            $update = DB::table('users')->where('id', $team2->id)->update([
                'balance' => $team2->balance + $team_2_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $team2->id,
                'charge' => '',
                'amount' => $team_2_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $team2->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        }
        
        $manager_1 = DB::table('users')->where('ranks', 'manager_1')->get();
        
        $manager_1_count = $manager_1->count();
        
        if($manager_1_count != 0){
        
        $manager_1_amount = $royal_amount / $manager_1_count;
        
        foreach($manager_1 as $manager1){
            $update = DB::table('users')->where('id', $manager1->id)->update([
                'balance' => $manager1->balance + $manager_1_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $manager1->id,
                'charge' => '',
                'amount' => $manager_1_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $manager1->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        }
        
        $manager_2 = DB::table('users')->where('ranks', 'manager_2')->get();
        
        $manager_2_count = $manager_2->count();
        
        if($manager_2_count != 0){
        
        $manager_2_amount = $royal_amount / $manager_2_count;
        
        foreach($manager_2 as $manager2){
            $update = DB::table('users')->where('id', $manager2->id)->update([
                'balance' => $manager2->balance + $manager_2_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $manager2->id,
                'charge' => '',
                'amount' => $manager_2_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $manager2->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        
        }
        
        $director_1 = DB::table('users')->where('ranks', 'director_1')->get();
        
        $director_1_count = $director_1->count();
        
        if($director_1_count != 0){
        
        $director_1_amount = $royal_amount / $director_1_count;
        
        foreach($director_1 as $director1){
            $update = DB::table('users')->where('id', $director1->id)->update([
                'balance' => $director1->balance + $director_1_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $director1->id,
                'charge' => '',
                'amount' => $director_1_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $director1->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        }
        
        
        $director_2 = DB::table('users')->where('ranks', 'director_2')->get();
        
        $director_2_count = $director_1->count();
        
        if($director_2_count){
        
        $director_2_amount = $royal_amount / $director_2_count;
        
        foreach($director_2 as $director2){
            $update = DB::table('users')->where('id', $director2->id)->update([
                'balance' => $director2->balance + $director_2_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $director2->id,
                'charge' => '',
                'amount' => $director_2_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $director2->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        }
        
        $ambassador = DB::table('users')->where('ranks', 'ambassador')->get();
        
        $ambassador_count = $ambassador->count();
        
        if($ambassador_count){
        
        $ambassador_amount = $royal_amount / $ambassador_count;
        
        foreach($ambassador as $ambassadors){
            $update = DB::table('users')->where('id', $ambassadors->id)->update([
                'balance' => $ambassadors->balance + $ambassador_amount
                ]);
            $add =  DB::table('transactions')->insert([ 
                'user_id' => $ambassadors->id,
                'charge' => '',
                'amount' => $ambassador_amount,
                'trx_type' => '+',
                'details' => 'Monthly Royalty Commission',
                'remark' => 'Royalty_commission',
                'trx' => getTrx(),
                'post_balance' => $ambassadors->balance,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        }
        
        
        $royal_reset = DB::table('royalty__funds')->where('id', 1)->update([
                'amount' => 0
                ]);
        
        
        
        
        
        
        
    }
}
