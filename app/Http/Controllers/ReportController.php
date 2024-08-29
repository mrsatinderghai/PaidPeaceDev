<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Transaction;
use App\Invoice;
use Carbon\Carbon;
use App\Truck;
use App\User;
use Auth;
use App\Work_Order;

class ReportController extends Controller
{
    public function finance_daily(Request $request)
    {
        if ($request->isMethod('get')) {
            $today = Carbon::now()->format('Y-m-d');
          } else if ($request->isMethod('post')) {
            $today = $request->report_date;
          }

        $transactions = Transaction::where('date', $today)->get();
        $daily_total = $transactions->sum('amount');
        $daily_count = $transactions->count();
        $cc_total = $transactions->where('tender', 'card')->sum('amount');
        $cc_count = $transactions->where('tender', 'card')->count();
        $cash_total = $transactions->where('tender', 'cash')->sum('amount');
        $cash_count = $transactions->where('tender', 'cash')->count();
        $check_total = $transactions->where('tender', 'check')->sum('amount');
        $check_count = $transactions->where('tender', 'check')->count();
        $unpaid_total = Invoice::where('is_paid', '<>', 1)->whereBetween('created_at', [Carbon::parse($today)->startOfDay(), Carbon::parse($today)->endOfDay()])->sum('amount');
        $unpaid_count = Invoice::where('is_paid', '<>', 1)->whereBetween('created_at', [Carbon::parse($today)->startOfDay(), Carbon::parse($today)->endOfDay()])->count();

        return view('reports.finance.daily', [
            'transactions' => $transactions,
            'daily_total' => $daily_total,
            'cc_total' => $cc_total,
            'cash_total' => $cash_total,
            'check_total' => $check_total,
            'unpaid_total' => $unpaid_total,
            'cc_count' => $cc_count,
            'cash_count' => $cash_count,
            'check_count' => $check_count,
            'unpaid_count' => $unpaid_count,
            'daily_count' => $daily_count,
            'today' => $today,
        ]);
    }

    public function finance_timeframe(Request $request)
    {
        if ($request->isMethod('get')) {
            $from_date = Carbon::now()->format('Y-m-d');
            $to_date = Carbon::now()->format('Y-m-d');
          } else if ($request->isMethod('post')) {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
          }

        $invoices = Invoice::whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])->get();
        //$transactions = Transaction::whereBetween('date', [$from_date, $to_date])->get();
        $transactions = [];
        foreach($invoices as $invoice) {
            foreach($invoice->transactions as $t) {
                array_push($transactions, $t);
            }
        }
        $transactions = collect($transactions);
        //$transactions = Transaction::select('transactions.*')->join('invoices', 'invoices.id', '=', 'transactions.invoice_id')->whereIn('invoices.id', $invoices)->get();
        $total = $transactions->sum('amount');
        $cc_total = $transactions->where('tender', 'card')->sum('amount');
        $cash_total = $transactions->where('tender', 'cash')->sum('amount');
        $check_total = $transactions->where('tender', 'check')->sum('amount');
        $unpaid_total = Invoice::where('is_paid', '<>', 1)->whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])->sum('amount');
        $invoices_count = Invoice::whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])->count();
        $invoices_average = Invoice::whereBetween('created_at', [Carbon::parse($from_date)->startOfDay(), Carbon::parse($to_date)->endOfDay()])->avg('amount');


        return view('reports.finance.timeframe', [
            'transactions' => $transactions,
            'total' => $total,
            'cc_total' => $cc_total,
            'cash_total' => $cash_total,
            'check_total' => $check_total,
            'unpaid_total' => $unpaid_total,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'invoices_count' => $invoices_count,
            'invoices_average' => $invoices_average,
        ]);
    }

    public function finance_payroll(Request $request)
    {
        if ($request->isMethod('get')) {
            $from_date = Carbon::now()->format('Y-m-d');
            $to_date = Carbon::now()->format('Y-m-d');
            $truck_id = 1;
            $user_id = 1;
        } else if ($request->isMethod('post')) {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $truck_id = $request->truck_id;
            $user_id = $request->user_id;
            if ($to_date == null) { 
                $to_date = Carbon::now()->format('Y-m-d');
            }
            if ($from_date == null) {
                $from_date = Carbon::now()->format('Y-m-d');
            }
        }
        $team_member_select = [];
        $truck_select = [];
        $team_members = Auth::user()->team->members;
        foreach($team_members as $team_member) {
            $team_member_select[$team_member->id] = $team_member->name;
        }
        $trucks = Truck::all();
        foreach($trucks as $truck) {
            $truck_select[$truck->id] = $truck->name;
        }

        $name = User::findOrFail($user_id)->name;
        $work_orders = Work_Order::whereBetween('appointment_date', [$from_date, $to_date])->where('assigned_to', $user_id)->get();
        $total_labor_charges = 0;
        $total_charges = 0;
        foreach($work_orders as $wo) {
            $labor_charges = 0;
            foreach($wo->services as $s) {
                $total_labor_charges += $s->pivot->line_cost;
                $labor_charges += $s->pivot->line_cost;
            }
            $wo->labor_charges = $labor_charges;
            if ($wo->invoice->first()) {
                $total_charges += $wo->invoice->first()->amount;
            } 
        }
        

        return view('reports.finance.payroll', [
            'work_orders' => $work_orders,
            'total_labor_charges' => $total_labor_charges, 
            'name' => $name,
            'from_date' => $from_date,
            'to_date' => $to_date,  
            'team_member_select' => $team_member_select,
            'truck_select' => $truck_select, 
            'total_charges' => $total_charges,
        ]);
    }
}
