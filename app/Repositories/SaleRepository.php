<?php

namespace App\Repositories;

use App\Sale;
use Auth;

class SaleRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */

    public function get_sales($team_id)
    {
        return Sale::where('team_id', $team_id)
            ->orderBy('start_date', 'desc')
            ->get();
    }

    public function leads($team_id)
    {
        return Sale::where('team_id', $team_id)
                ->where('status', '<>', 'Accepted')
                ->where('status', '<>', 'Rejected')
                ->where('status', '<>', 'Completed')
                ->orderBy('start_date', 'desc')
                ->get();
    }

    public function rejected($team_id)
    {
        return Sale::where('team_id', $team_id)
                ->where('status', 'Rejected')
                ->orderBy('start_date', 'desc')
                ->get();
    }

    public function accepted($team_id)
    {
        return Sale::where('team_id', $team_id)
                ->where('status', 'Accepted')
                ->orderBy('start_date', 'desc')
                ->get();
    }

    public function company_sales($company_id)
    {
        return Sale::where('company_id', $company_id)
            ->orderBy('start_date', 'desc')
            ->get();
    }

    public function open_sales($team_id)
    {
        return Sale::where('team_id', $team_id)
            ->where('status', 'Pending')
            ->get();
    }

    public function pending_leads()
    {
        return Sale::where('team_id', Auth::user()->team_id)
                ->where('status', 'Pending')
                ->orderBy('start_date', 'desc')
                ->get();
    }

    public function by_status($status)
    {
      return Sale::where('team_id', Auth::user()->team_id)
                ->where('status', $status)
                ->where('status', '<>', 'Completed')
                ->orderBy('start_date', 'desc')
                ->get();
    }

    public function status_options()
    {
      return array(
        'Pending' => 'Pending',
        'Awaiting Customer Response' => 'Awaiting Customer Response',
        'Proposal' => 'Proposal',
        'Accepted' => 'Accepted',
        'Rejected' => 'Rejected',
        'Completed' => 'Completed',
      );
    }

}
