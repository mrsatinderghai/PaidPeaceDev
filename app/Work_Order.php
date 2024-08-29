<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_Order extends Model
{
    protected $table = 'work_orders';
    protected $fillable = ['customer_id', 'status', 'appointment_time', 'assigned_to', 'completed_on', 'reason', 'comments', 'delivery_date'];
    protected $test = '';
    
    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }

    public function assigned_to_user()
    {
      return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function services()
    {
      return $this->belongsToMany('App\Service', 'work_order_service', 'work_order_id', 'service_id')->withPivot('labor_hours', 'sale_price', 'line_cost', 'id', 'quantity');
    }

    public function products()
    {
      return $this->belongsToMany('App\Product', 'work_order_product', 'work_order_id', 'product_id')->withPivot('tax', 'sale_price', 'line_cost', 'quantity');
    }

    public function invoice()
    {
      return $this->hasMany('App\Invoice', 'work_order_id');
    }

    public function has_service($id)
    {
      return ! $this->services->filter(function($service) use ($id)
      {
          return $service->id == $id;
      })->isEmpty();
    }

    public function has_product($id)
    {
      return ! $this->products->filter(function($product) use ($id)
      {
          return $product->id == $id;
      })->isEmpty();
    }

    public function truck()
    {
      return $this->belongsTo('App\Truck');
    }

    public function style()
    {
      $color = $this->customer->area_color();
      if ($this->status == 'Delivery') {
        $style = "background: repeating-linear-gradient( 45deg, ". $color .", ". $color. " 10px, white 10px, white 20px );";
      } else {
        $style = "background-color: " .  $color.';';
      }

      if($this->status =='Installation'){
        $style.="
          background-image: radial-gradient(white 40%, transparent);
          background-size: 10px 10px;
        ";
      }

      return $style;
    }

    public function custom_parts()
    {
      return $this->hasMany('App\Custom_Part', 'work_order_id', 'id');
    }

    public function custom_services()
    {
      return $this->hasMany('App\Custom_Service', 'work_order_id', 'id');
    }

    public function plaque()
    {
      $html = '<div class="work_order_plaque" draggable="true" ondragstart="drag(event)" id="' . $this->id . '" style="' .  $this->style($this->id) . '" ';
      $html .= '<a href="#" data-toggle="modal" data-target="#woDetailsModal' . $this->id .'">'.substr($this->customer->full_name(),0, 10).'</a><span style="float:right;">'.$this->customer->zip.'</span><br />'.$this->code.'<span style="float:right;">'.$this->customer->phone_number_formatter().'</span></div>';
      return $html;
    }




}
