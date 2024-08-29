<?php

namespace App\Repositories;

use App\Invoice;

class InvoiceRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function sale_invoices($sale_id)
    {
        return Invoice::where('sale_id', $sale_id)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function team_invoices($team_id)
    {
        return Invoice::where('team_id', $team_id)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function team_invoices_raw($team_id)
    {
        return Invoice::where('team_id', $team_id);
    }

    public function company_invoices($company_id)
    {
        return Invoice::where('company_id', $company_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function need_sent()
    {
      return Invoice::where('is_sent', 0)->get();
    }

    public function need_sent_raw(){
        return Invoice::where('is_sent',0);
    }

    public function unpaid($team_id)
    {
        return Invoice::where('team_id', $team_id)
                ->where('status', 'Unpaid')
                ->orderBy('created_at', 'desc')
                ->get();
    }

    public function unpaid_raw($team_id)
    {
        return Invoice::where('team_id', $team_id)
                ->where('status', 'Unpaid');
    }

}
