<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{

    protected $transactions;

    public function __construct(TransactionRepository $transactions)
    {
        $this->middleware('auth');
        $this->transactions = $transactions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = $this->transactions->all($request->user()->team_id);
        $balance = $this->balance($transactions);
        return view('transactions.index',[
            'transactions' => $transactions,
            'receivables' => $this->transactions->receivable($request->user()->team_id),
            'payables' => $this->transactions->payable($request->user()->team_id),
            'title' => 'Ledger',
            'balance' => $balance,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'other_party' => 'required|max:255',
            'amount' => 'required',
        ]);

        $transaction = new Transaction;

        $transaction->other_party = $request->other_party;
        $transaction->amount = $request->amount;
        $transaction->type = $request->type;
        $transaction->team_id = $request->user()->team_id;
        $transaction->date = $request->date;

        $transaction->save();

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        // $this->authorize('destroy', $transaction);
        $transaction->delete();
        return Redirect::back();
    }

    public function payable(Request $request)
    {
        $transactions = $this->transactions->payable($request->user()->team_id);
        $balance = $this->balance($transactions);
        return view('transactions.index',[
            'transactions' => $transactions,
            'title' => 'Payables',
            'balance' => $balance,
        ]);
    }

    public function receivable(Request $request)
    {
        $transactions = $this->transactions->receivable($request->user()->team_id);
        $balance = $this->balance($transactions);
        return view('transactions.index',[
            'transactions' => $transactions,
            'title' => 'Receivables',
            'balance' => $balance,
        ]);
    }

    public function dashboard(Request $request)
    {
        return view ('transactions.dashboard', [
            'transactions' => $this->transactions->all($request->user()->team_id),
            'payable' => $this->transactions->total_amount($request->user()->team_id, 'Payable'),
            'receivable' => $this->transactions->total_amount($request->user()->team_id, 'Receivable'),
            'title' => 'Cash Flow',
            ]);
    }

    private function balance($transactions)
    {
        $balance = 0;
        foreach($transactions as $transaction)
        {
            if ($transaction->type == 'Payable')
            {
                $balance = $balance - $transaction->amount;
            }
            else
            {
                $balance = $balance + $transaction->amount;
            }
        }

        return $balance;
    }
}
