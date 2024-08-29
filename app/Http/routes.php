<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::get('/access_denied', 'HomeController@access_denied');
    Route::post('/home/tweet', ['as' => 'home.tweet', 'uses' => 'HomeController@tweet']);
    Route::post('/home/fbstatus', ['as' => 'home.fbstatus', 'uses' => 'HomeController@fbstatus']);

  
    Route::get('task/team', 'TaskController@team');
    Route::get('task/project', 'TaskController@project');
    Route::get('task/hot', 'TaskController@hot');
    Route::resource('task', 'TaskController');

    //Team routes
    Route::resource('team', 'TeamController');

    //Note routes
    Route::resource('note', 'NoteController');

    //Company routes
    Route::resource('company', 'CompanyController');

    //Contact routes
    Route::resource('contact', 'ContactController');

    //Zip Code routes
    Route::resource('zipcodearea', 'ZipCodeAreaController');

    //Export routes
    Route::resource('export', 'CustomerController@export');
    Route::post('export_option', 'CustomerController@export_option')->name('customer.export_option');
    Route::post('export_whole', 'CustomerController@export_whole')->name('customer.export_whole');

    //Sales routes
    Route::get('sale/dashboard', 'SaleController@dashboard');
    Route::get('/sale/leads', 'SaleController@leads');
    Route::get('/sale/rejected', 'SaleController@rejected');
    Route::get('/sale/accepted', 'SaleController@accepted');
    Route::get('sale/pipeline', 'SaleController@pipeline');
    Route::resource('sale', 'SaleController');

    //Transaction routes
    Route::get('transaction/dashboard', 'TransactionController@dashboard');
    Route::get('transaction/receivable', 'TransactionController@receivable');
    Route::get('transaction/payable', 'TransactionController@payable');
    Route::resource('transaction', 'TransactionController');

    //Invoice routes
    Route::get('data/invoices', 'InvoiceController@indexData');
    Route::get('data/invoices/unpaid', 'InvoiceController@unpaidData');
    Route::get('data/invoices/all', 'InvoiceController@allData');
    Route::get('invoice/unpaid', 'InvoiceController@unpaid');
    Route::get('invoice/all', 'InvoiceController@all');
    Route::match(['get', 'post'], 'invoice/daily', 'InvoiceController@daily')->name('invoices.daily');
    Route::match(['get', 'post'], 'invoice/timeframe', 'InvoiceController@timeframe')->name('invoices.timeframe');
    Route::patch('invoice/send/{id}', 'InvoiceController@send');
    Route::patch('invoice/resend/{id}', 'InvoiceController@resend');
    Route::get('invoice/check_out/{id}', 'InvoiceController@check_out');
    Route::post('invoice/process_payment/{id}', 'InvoiceController@process_payment');
    Route::resource('invoice', 'InvoiceController');
//     Route::post('invoice/{id}', 'InvoiceController@show');

    //Workflow routes
    Route::resource('workflow', 'WorkflowController');

    //User routes
    Route::resource('user', 'UserController');
    Route::post('user/update_roles', ['as' => 'user.update_roles', 'uses' => 'UserController@update_roles']);

    Route::resource('role', 'RoleController');

    Route::get('activity/log/{type}/{id}/{parent_type}', 'ActivityController@log');
    Route::resource('activity', 'ActivityController');

    Route::patch('product/update_inventory/{id}', 'ProductController@update_inventory');
    Route::get('product/retire/{id}', ['as' => 'product.retire', 'uses' => 'ProductController@retire']);
    Route::resource('product', 'ProductController');

    Route::get('service/retire/{id}', ['as' => 'service.retire', 'uses' => 'ServiceController@retire']);
    Route::resource('service', 'ServiceController');

    Route::patch('customer/update_notes/{id}', ['as' => 'customer.update_notes', 'uses' => 'CustomerController@update_notes']);
    Route::post('customer/search', ['as' => 'customer.search', 'uses' => 'CustomerController@search']);
    Route::post('customer/find', 'CustomerController@find');
    Route::get('customer/index/{sort_by?}', 'CustomerController@index');
    Route::get('customer/specials', ['as' => 'customer.specials', 'uses' => 'CustomerController@specials']);
    Route::resource('customer', 'CustomerController');


    Route::match(['get', 'post'], 'reports/finance/daily', 'ReportController@finance_daily')->name('reports.finance.daily');
    Route::match(['get', 'post'], 'reports/finance/timeframe', 'ReportController@finance_timeframe')->name('reports.finance.timeframe');
    Route::match(['get', 'post'], 'reports/finance/payroll', 'ReportController@finance_payroll')->name('reports.finance.payroll');

    
    Route::match(['get','post'], 'work_order/analyze', 'Work_OrderController@analyze')->name('work_order.analyze');
    Route::post('work_order/search', ['as' => 'work_order.search', 'uses' => 'Work_OrderController@search']);
    Route::post('work_order/update_stop_orders', ['as' => 'work_order.update_stop_orders', 'uses' => 'Work_OrderController@update_stop_orders']);
    Route::get('work_order/shop_work/{id}', ['as' => 'work_order.shop_work', 'uses' => 'Work_OrderController@shop_work']);
    Route::get('work_order/truck_schedule/{id}/{date?}', ['as' => 'work_order.truck_schedule', 'uses' => 'Work_OrderController@truck_schedule']);
    Route::get('work_order/completed', 'Work_OrderController@completed');
    Route::get('work_order/shop_work', 'Work_OrderController@shop_work_list');
    Route::get('work_order/schedule_for_delivery', 'Work_OrderController@schedule_for_delivery_list');
    Route::get('work_order/update_schedule/{id}/{date}/{time}/{truck}', 'Work_OrderController@update_schedule');
    Route::get('work_order/schedule/{date?}', 'Work_OrderController@schedule');
    Route::get('work_order/invoice/{id}', 'Work_OrderController@invoice');
    Route::patch('work_order/update_service/{id}', 'Work_OrderController@update_service');
    Route::patch('work_order/update_product/{id}', 'Work_OrderController@update_product');
    Route::get('work_order/index/{sort_by?}', 'Work_OrderController@index');
    Route::get('work_order/cancel/{id}', 'Work_OrderController@cancel');
    Route::patch('work_order/set_time/{id}', ['as' => 'work_order.set_time', 'uses' => 'Work_OrderController@set_time']);
    Route::post('work_order/store_new_part', ['as' => 'work_order.store_new_part', 'uses' => 'Work_OrderController@store_new_part']);
    Route::get('work_order/{id}/remove_part/{part_id}', 'Work_OrderController@remove_part');
    Route::get('work_order/{id}/remove_service/{service_id}', 'Work_OrderController@remove_service');
    Route::get('work_order/my_schedule', ['as' => 'work_order.my_schedule', 'uses' => 'Work_OrderController@my_schedule']);
    Route::post('work_order/filter', ['as' => 'work_order.filter', 'uses' => 'Work_OrderController@filter']);
    Route::resource('work_order', 'Work_OrderController');

    Route::post('truck/assign_user_to_day', 'TruckController@assign_user_to_day');
    Route::resource('truck', 'TruckController');

    Route::post('date_note/save', 'Date_NoteController@save');

    Route::get('time_slot_locks/lock/{date}/{truck_id}/{time_slot}/{action}', ['as' => 'time_slot_locks.lock', 'uses' => 'Work_OrderController@lock_time_slot']);

    Route::post('service/get_sell_price', 'ServiceController@get_sell_price')->name('service.get_sell_price');
    Route::post('product/get_sell_price', 'ProductController@get_sell_price')->name('product.get_sell_price');

    Route::get('truck/hide/{id}', 'TruckController@hide')->name('truck.hide');

    Route::post('work_order/quote', 'Work_OrderController@quote')->name('work_order.quote');

    Route::post('zip_code_area/color_by_zip', 'ZipCodeAreaController@color_by_zip')->name('zip_code_area.color_by_zip');
 




    /*
     *  Social Media Routes
     */

    //Twitter
    Route::get('twitter/login', ['as' => 'twitter.login', function(){
    // your SIGN IN WITH TWITTER  button should point to this route
        $sign_in_twitter = true;
        $force_login = false;

    // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret']))
        {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect::to($url);
        }

        return Redirect::route('twitter.error');
    }]);

    Route::get('twitter/callback', ['as' => 'twitter.callback', function() {
    // You should set this route on your Twitter Application settings as the callback
    // https://apps.twitter.com/app/YOUR-APP-ID/settings
        if (Session::has('oauth_request_token'))
        {
            $request_token = [
            'token'  => Session::get('oauth_request_token'),
            'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($request_token);

            $oauth_verifier = false;

            if (Input::has('oauth_verifier'))
            {
                $oauth_verifier = Input::get('oauth_verifier');
            }

        // getAccessToken() will reset the token for you
            $token = Twitter::getAccessToken($oauth_verifier);

            if (!isset($token['oauth_token_secret']))
            {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error))
            {
            // $credentials contains the Twitter user object with all the info about the user.
            // Add here your own user logic, store profiles, create new users on your tables...you name it!
            // Typically you'll want to store at least, user id, name and access tokens
            // if you want to be able to call the API on behalf of your users.

            // This is also the moment to log in your users if you're using Laravel's Auth class
            // Auth::login($user) should do the trick.

                Session::put('access_token', $token);

                return Redirect::to('/home')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }

            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }]);

    Route::get('twitter/error', ['as' => 'twitter.error', function(){
    // Something went wrong, add your own error handling here
    }]);

    Route::get('twitter/logout', ['as' => 'twitter.logout', function(){
        Session::forget('access_token');
        return Redirect::to('/')->with('flash_notice', 'You\'ve successfully logged out!');
    }]);

    //Facebook
    Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
    {
    // Send an array of permissions to request
        $login_url = $fb->getLoginUrl(['email', 'publish_actions', 'manage_pages', 'publish_pages']);
        Session::put('facebook_login_url', $login_url);
    // Obviously you'd do this in blade :)
        return Redirect::to($login_url);
    });

// Endpoint that is redirected to after an authentication attempt
    Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
    {
    // Obtain an access token.
        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
        if (! $token) {
        // Get the redirect helper
            $helper = $fb->getRedirectLoginHelper();

            if (! $helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

        // User denied the request
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
                );
        }

        if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
            $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

    // Save for later
        Session::put('fb_user_access_token', (string) $token);


    // Get basic info on the user from Facebook.
        try {
            $response = $fb->get('/me?fields=id,name,email');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        $facebook_user = $response->getGraphUser();


        //TIME TO ADD PAGE ACCESS
        /*
         *  This will need to be changed when other people start using the app.
         *  Will have to pull their list of pages and ask what they want to post as and then set the page_id below
         *
         */
        $page_id_8180 = '949479431749371';
        try
        {
            $page_access_token = $fb->get('/'.$page_id_8180.'?fields=access_token')->getGraphObject()->getProperty('access_token');
        }
        catch(Facebook\Exceptions\FacebookResponseException $e)
        {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        Session::put('fb_page_access_token', (string) $page_access_token);
        return redirect('/home')->with('message', 'Successfully logged in with Facebook');


        });
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',  function ($api) {
    $api->get('user/{id}', ['as' => 'users.show', 'uses' => 'App\Http\Controllers\Api\V1\Controllers\UserController@show']);
    $api->get('task/{user_id}', ['as' => 'tasks.mine', 'uses' => 'App\Http\Controllers\Api\V1\Controllers\TaskController@mine']);
});
