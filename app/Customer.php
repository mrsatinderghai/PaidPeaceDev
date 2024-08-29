<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Zip_Code_Area;

class Customer extends Model
{
    protected $fillable = ['team_id', 'first_name', 'last_name', 'address1', 'address2', 'city', 'state', 'zip', 'phone', 'email', 'equipment_make', 'equipment_model', 'do_not_service', 'cell_phone', 'tax_exempt', 'tax_exempt_id', 'referred_by', 'notes', 'preferred_contact_method', 'do_not_contact'];

    public $referred_by_options = ['Previous Customer', 'Google', 'Referral', 'Next Door App', 'Facebook', 'Saw Trailer'];
    
    public $contact_methods = ['', 'Phone Call', 'Text', 'Email'];
  
    public function team()
    {
    	$this->belongsTo('App\Team', 'team_id');
    }

    public function full_name()
    {
      return $this->first_name.' '.$this->last_name;
    }

    public function work_orders()
    {
      return $this->hasMany('App\Work_Order');
    }

    public function address()
    {
      $address = $this->address1;
      if ($this->address2 != null) {
        $address .= "<br/>".$this->address2;
      }
      return $address;
    }

    public function full_address()
    {
      $address = $this->address1;
      if ($this->address2 != null) {
        $address .= "<br />".$this->address2;
      }
      $address .= "<br />".$this->city.", ".$this->state."  ".$this->zip;
      return $address;
    }

    public function area()
    {
      $zca = Zip_Code_Area::where('zip_code', $this->zip)->first();
      if (! is_null($zca)) {
        return $zca->area;
      }
      return 'Unknown';
    }

    public function area_color()
    {
      if ($this->area_color_override != null || $this->area_color_override != "") {
        //dd('fireing this!');
        return $this->area_color_override;
      }
      if ($this->area() == 'E') {
        return 'green';
      } elseif ($this->area() == 'NW') {
        return 'yellow';
      } elseif ($this->area() == 'N') {
        return 'deepskyblue';
      } elseif ($this->area() == 'NE') {
        return 'red';
      } elseif ($this->area() == 'W') {
        return 'hotpink';
      } elseif ($this->area() == 'C') {
        return 'lightsteelblue';
      } elseif ($this->area() == 'SW') {
        return 'orange';
      } elseif ($this->area() == 'S') {
        return 'purple';
      } elseif ($this->area() == 'SE') {
        return 'tan';
      } else {
        return 'white';
      }
    }

    public function area_options() {
      $options = array();
      $options[null] = 'None';
      $options['green'] = 'East';
      $options['yellow'] = 'North West';
      $options['deepskyblue'] = 'North';
      $options['red'] = 'North East';
      $options['hotpink'] = 'West';
      $options['lightsteelblue'] = 'Central';
      $options['orange'] = 'South West';
      $options['purple'] = 'South';
      $options['tan'] = 'South East';
      

      return $options;
    }

    public function phone_number_formatter($number = 'phone')
    {
      if ($number == 'phone') {
        $string = $this->phone;
      } else {
        $string = $this->cell_phone;
      }

      if (strpos($string, '-') !== false) {
          return $string;
      }
      $p1 = substr($string, 0, 3);
      $p2 = substr($string, 3, 3);
      $p3 = substr($string, 6, 4);

      $formatted = $p1 . '-' . $p2 . '-' . $p3;

      return $formatted;
    }

    public function map_link()
    {
      $url = 'https://www.google.com/maps/search/?api=1&query=';
      $string = $this->address1 . $this->address2 . $this->city . $this->state . $this->zip;
      $string = rawurlencode($string);
      $url .= $string;
      $html = "<a href=" . $url . " target='new'><i class='fa fa-map'></i></a>";

      return $html;
    }



}
