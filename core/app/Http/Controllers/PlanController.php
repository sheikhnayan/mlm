<?php

namespace App\Http\Controllers;

use App\Models\BvLog;
use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Royalty_Fund;
use App\Models\UserExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use sum;
use App\Models\PlanPurchase;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    function planIndex()
    {
        $data['page_title'] = "Plans";
        $data['plans'] = Plan::whereStatus(1)->get();
        return view($this->activeTemplate . '.user.plan', $data);

    }

    function planStore(Request $request)
    {
        
        $this->validate($request, ['plan_id' => 'required|integer']);
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find(Auth::id());


        if ($user->balance < $request->amount) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }

            $oldPlan = $user->plan_id;
            $user->plan_id = $plan->id;
            $user->com_type = $request->com_type;
            $user->balance -= $request->amount;
            $user->total_invest += $request->amount;
            $user->save();
            
            $planAdd = new PlanPurchase;
            
            $planAdd->plan_id = $request->plan_id;
            
            $planAdd->user_id = Auth::user()->id;
            
            $planAdd->amount = $request->amount;
            
            $planAdd->comission_type = $request->com_type;
            
            $planAdd->save();
            
            $royal = Royalty_fund::where('id',1)->first();
            
            $royalty = Royalty_fund::where('id',1)->update([
                'amount' => $royal->amount + ($request->amount/100),
                ]);
                
                
            $ref_user = $user->ref_id;
            
            $ref_info = User::where('id', $ref_user)->first();
            
            if($user->position == 1){
            $sell = User::where('id', $ref_user)->update([
                'total_sell_left' => $ref_info->total_sell_left + $request->amount
                ]);
            }elseif($user->position ==2){
                $sell = User::where('id', $ref_user)->update([
                'total_sell_right' => $ref_info->total_sell_right + $request->amount
                ]);
            }
            
            if($ref_info->total_sell_left >= 3333  AND $ref_info->total_sell_left < 16667){
                if($ref_info->total_sell_right >=3333 ){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'team_leader_1'
                        ]);
                }
                
            }elseif($ref_info->total_sell_left >= 16667 AND $ref_info->total_sell_left < 33333){
                if($ref_info->total_sell_right >=16667){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'team_leader_2'
                        ]);
                }
                
            }elseif($ref_info->total_sell_left >= 33333 AND $ref_info->total_sell_left < 166666){
                if($ref_info->total_sell_right >=33333){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'manager_1'
                        ]);
                }
                
            }elseif($ref_info->total_sell_left >= 166666 AND $ref_info->total_sell_left < 1666666){
                if($ref_info->total_sell_right >=166666){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'manager_2'
                        ]);
                }
                
            }elseif($ref_info->total_sell_left >= 1666666 AND $ref_info->total_sell_left < 8333333){
                if($ref_info->total_sell_right >=1666666){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'director_1'
                        ]);
                }
                
            }elseif($ref_info->total_sell_left >= 8333333 AND $ref_info->total_sell_left < 33333333){
                if($ref_info->total_sell_right >=8333333){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'director_2'
                        ]);
                }
                
            }elseif($ref_info->total_sell_left >= 33333333){
                if($ref_info->total_sell_right >=33333333){
                    $update_rank = User::where('id', $ref_user)->update([
                        'rank'=>'ambassador'
                        ]);
                }
                
            }
            
            
            $trx = $user->transactions()->create([
                'amount' => $request->amount,
                'trx_type' => '-',
                'details' => 'Purchased ' . $plan->name,
                'remark' => 'purchased_plan',
                'trx' => getTrx(),
                'post_balance' => getAmount($user->balance),
            ]);

            notify($user, 'plan_purchased', [
                'plan' => $plan->name,
                'amount' => getAmount($request->amount),
                'currency' => $gnl->cur_text,
                'trx' => $trx->trx,
                'post_balance' => getAmount($user->balance) . ' ' . $gnl->cur_text,
            ]);
            // if ($oldPlan == 0) {
            //     updatePaidCount($user->id);
            // }
            $details = Auth::user()->username . ' Subscribed to ' . $plan->name . ' plan.';
            
            $bv_com = ($request->amount / 100)*$plan->bv;
            
            updateBV($user->id, $bv_com, $details);
            
            $tree_com = ($request->amount / 100)*$plan->tree_com;

            if ($plan->tree_com > 0) {
                treeComission($user->id, $tree_com, $details);
            }

            referralComission($user->id, $details, $request->amount);

            $notify[] = ['success', 'Purchased ' . $plan->name . ' Successfully'];
            return redirect()->route('user.home')->withNotify($notify);

    }


    public function binaryCom()
    {
        $data['page_title'] = "Binary Commission";
        $data['logs'] = Transaction::where('user_id', auth()->id())->where('remark', 'binary_commission')->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.transactions', $data);
    }

    public function binarySummery()
    {
        $data['page_title'] = "Binary Summery";
        $data['logs'] = UserExtra::where('user_id', auth()->id())->firstOrFail();
        return view($this->activeTemplate . '.user.binarySummery', $data);
    }

    public function bvlog(Request $request)
    {

        if ($request->type) {
            if ($request->type == 'leftBV') {
                $data['page_title'] = "Left BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('position', 1)->where('trx_type', '+')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'rightBV') {
                $data['page_title'] = "Right BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('position', 2)->where('trx_type', '+')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'cutBV') {
                $data['page_title'] = "Cut BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('trx_type', '-')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            } else {
                $data['page_title'] = "All Paid BV";
                $data['logs'] = BvLog::where('user_id', auth()->id())->where('trx_type', '+')->orderBy('id', 'desc')->paginate(config('constants.table.default'));
            }
        } else {
            $data['page_title'] = "BV LOG";
            $data['logs'] = BvLog::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        }

        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.bvLog', $data);
    }

    public function myRefLog()
    {
        $data['bvs'] = User::where('ref_id', Auth::user()->id)->get();
        $data['page_title'] = "My Referral";
        $data['empty_message'] = 'No data found';
        $data['logs'] = User::where('ref_id', auth()->id())->latest()->paginate(config('constants.table.default'));
        return view($this->activeTemplate . '.user.myRef', $data);
    }

    public function myTree()
    {
        $data['tree'] = showTreePage(Auth::id());
        $data['page_title'] = "My Tree";
        return view($this->activeTemplate . 'user.myTree', $data);
    }


    public function otherTree(Request $request, $username = null)
    {
        if ($request->username) {
            $user = User::where('username', $request->username)->first();
        } else {
            $user = User::where('username', $username)->first();
        }
        if ($user && treeAuth($user->id, auth()->id())) {
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Tree of " . $user->fullname;
            return view($this->activeTemplate . 'user.myTree', $data);
        }

        $notify[] = ['error', 'Tree Not Found or You do not have Permission to view that!!'];
        return redirect()->route('user.my.tree')->withNotify($notify);

    }

}
