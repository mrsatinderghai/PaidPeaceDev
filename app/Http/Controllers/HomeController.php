<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Repositories\SaleRepository;
use Twitter;
use Facebook;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskRepository $tasks, SaleRepository $sales)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
        $this->sales = $sales;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('return_url', $request->path());

        $sales = $this->sales->pending_leads();

        return view('home', [
          'tasks' => $this->tasks->assigned_to_user($request->user()),
          'team_tasks' => $this->tasks->team_tasks(),
          'hot_tasks' => $this->tasks->due_in_days(7),
            'sales' => $sales,
            'pending_sales' => $this->sales->by_status('Pending'),
            'awaiting_customer_sales' => $this->sales->by_status('Awaiting Customer Response'),
            'proposal_sales' => $this->sales->by_status('Proposal'),
            'accepted_sales' => $this->sales->by_status('Accepted'),
            'rejected_sales' => $this->sales->by_status('Rejected'),
            ]);
    }

    public function access_denied()
    {
        return view('access_denied');
    }

    public function tweet(Request $request)
    {
        Twitter::postTweet(['status' => $request->tweet, 'format' => 'json']);
        return redirect($request->session()->get('return_url'));
    }

    public function fbstatus(Request $request)
    {
        Facebook::post('/949479431749371/feed?message='. $request->fbstatus . '&access_token='. $request->session()->get('fb_page_access_token'));
        return redirect($request->session()->get('return_url'));
    }

}
