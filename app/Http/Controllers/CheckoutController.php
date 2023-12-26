<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Session;
use App\Library\SslCommerz\SslCommerzNotification;
use DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    private $customer, $deliveryInfo,$orderInfo,$orderDetailsInfo;
    public $url,$apikey,$secretKey,$callerId,$toUser,$messageContent,$response,$body,$data;
    public function index()
    {
        if (Session::get('customer_id'))
        {
            $this->customer = Customer::find(Session::get('customer_id'));
            return view('website.checkout.index',['customer'=>$this->customer]);
        }
        else
        {
            return redirect('/');
        }

    }

    public function placeOrder(Request $request)
    {
        // Your API endpoint URL
        $url = 'https://sms.dinisoftbd.com:7790/sendtext';

// API key and secret key
        $apiKey = '83f4751692fdf3f6';
        $secretKey = '33b1e9a8';

// Caller ID, user, and message content
        $callerID = 'wsc';
        $toUser = '01977699806';
        $messageContent = 'Thank you for placing an order with us. You will receive a phone call to verify your order. We appreciate your co-operation - Workstation Communication';

// Make a GET request to the API
        $response = Http::withoutVerifying()->get($url, [
            'apikey' => $apiKey,
            'secretkey' => $secretKey,
            'callerID' => $callerID,
            'toUser' => $toUser,
            'messageContent' => $messageContent,
        ]);

// Get the response body as a string
        $body = $response->body();

// Process the response as needed
// For example, you can convert the JSON response to an array
        $data = json_decode($body, true);


        $this->deliveryInfo = Delivery::storeDeliveryInfo($request);
        $this->orderInfo = Order::storeOrderInfo($request,$this->deliveryInfo->id);
        $this->orderDetailsInfo = OrderDetails::storeOrderDetails($this->orderInfo->id);

        if ($request->payment == 'cod')
        {
            return view('website.checkout.order-complete',[
                'orderNumber' => $this->orderInfo->order_number,
                'orderDetails' => $this->orderDetailsInfo
            ]);
        }
        else
        {
            $post_data = array();
            $post_data['total_amount'] = $this->orderInfo->payment_amount; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = $this->orderInfo->transaction_id; // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $this->deliveryInfo->first_name;
            $post_data['cus_email'] = $this->deliveryInfo->email;
            $post_data['cus_add1'] = $this->deliveryInfo->address;
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $this->deliveryInfo->phone;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }
//        if ($request->place_order)
//        {
//
//        }
//        else
//        {
//            return back();
//        }
    }
}
