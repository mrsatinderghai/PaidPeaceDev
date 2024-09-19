<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Models\User;
use DB;

class TransactionRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function all($team_id)
    {
        return Transaction::where('team_id', $team_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function receivable($team_id)
    {
        return Transaction::where('team_id', $team_id)
            ->where('type', 'Receivable')
            ->orderBy('created_at', 'asc')
            ->get();
    }
    
    public function payable($team_id)
    {
        return Transaction::where('team_id', $team_id)
            ->where('type', 'Payable')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function total_amount($team_id, $column)
    {
        return DB::table('transactions')
                ->where('team_id', $team_id)
                ->where('type', $column)
                ->sum('amount');
    }

}