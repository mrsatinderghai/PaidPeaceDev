<?php

namespace App\Repositories;

use App\Work_Order;
use Auth;

class Work_OrderRepository
{
  /**
  * Get all of the tasks for a given user.
  *
  * @param  User  $user
  * @return Collection
  */
  public function all()
  {
    return Work_Order::all();
  }

  public function active($orderBy)
  {
    
    return Work_Order::where('status', '<>', 'Completed')->where('status', '<>', 'Complete')->orderBy($orderBy, 'DESC')->paginate(15);
  }

  public function customer_work_orders($customer_id)
  {
    return Work_Order::where('customer_id', $customer_id)->paginate(15);
  }

  public function completed()
  {
    return Work_Order::where('status', 'Complete')->orWhere('status', 'Completed')->paginate(15);
  }

  public function shop_work()
  {
    return Work_Order::where('shop_work', True)->paginate(15);
  }

  public function schedule_for_delivery()
  {
//     return Work_Order::where('truck_id', 12)->paginate(15);
    return Work_Order::where('status', 'Schedule for Delivery')->paginate(15);
  }

  public function filter_by($filter_by)
  {
    return Work_Order::where('status', $filter_by)->get();
  }

}
