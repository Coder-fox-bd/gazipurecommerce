<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use App\Events\OrderShipped;
use Cart;
use Config;

class Checkout extends Component
{
    public $first_name;
    public $last_name;
    public $address;
    public $city;
    public $country;
    public $post_code;
    public $phone_number;
    public $notes;

    public function sendNotification($order_details)
    {
        $firebaseToken = Admin::whereNotNull('device_token')->pluck('device_token')->all();

        $secret_key = config('app.firebase_secret');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'New Order',
                "body" => $order_details['order_no']. ' has been placed by '. $order_details['name'] .'.',
                "icon" => config('app.url')."/icon.png",
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $secret_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return redirect()->route('account.orders');
    }

    public function storeOrderDetails($formData)
    {
        if (session()->get('buy')) {
            $validator = Validator::make($formData, [
                "first_name"    => "required|min:3",
                "last_name"  => "required|min:3",
                "address"  => "required",
                "city"  => "required",
                "country"  => "required",
                "post_code"  => "required",
                "phone_number"  => "required",
                "notes"  => "nullable",
            ]);
            $validator->validate();
            $grand_total = 0;
            $item = session()->get('buy');
            $grand_total += $item[0]['price'] * $item[0]['quantity'];

            $order = Order::create([
                'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                'user_id'           =>   auth()->user()->id,
                'status'            =>  'pending',
                'grand_total'       =>  $grand_total,
                'item_count'        =>  $item[0]['quantity'],
                'payment_status'    =>  0,
                'payment_method'    =>  null,
                'name'              =>  $formData['first_name']." ".$formData['last_name'],
                'address'           =>  $formData['address'],
                'city'              =>  $formData['city'],
                'country'           =>  $formData['country'],
                'post_code'         =>  $formData['post_code'],
                'phone_number'      =>  $formData['phone_number'],
                'notes'             =>  $formData['notes'],
            ]);
    
            if ($order) {
                $price_sum = $item[0]['price'] * $item[0]['quantity'];
                // A better way will be to bring the product id with the cart items
                $orderItem = new OrderItem([
                    'product_id'        =>  $item[0]['id'],
                    'product_attribute' =>  $item[0]['attribute'], 
                    'product_variant'   =>  $item[0]['variation'],
                    'quantity'          =>  $item[0]['quantity'],
                    'price'             =>  $price_sum,
                ]);
                
                $order->items()->save($orderItem);
                unset($item[0]); 
                session()->put('buy', $item);
            }
            $order_details = ['order_no' => $order->order_number, 'name' => $order->name];
            event(new OrderShipped($order));
            $this->SendNotification($order_details);
        }else {
            if (Cart::getTotalQuantity()>0) {
                $validator = Validator::make($formData, [
                    "first_name"    => "required|min:3",
                    "last_name"  => "required|min:3",
                    "address"  => "required",
                    "city"  => "required",
                    "country"  => "required",
                    "post_code"  => "required",
                    "phone_number"  => "required",
                    "notes"  => "nullable",
                ]);
                $validator->validate();
                $order = Order::create([
                    'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                    'user_id'           =>  auth()->user()->id,
                    'status'            =>  'pending',
                    'grand_total'       =>  Cart::getTotal(),
                    'item_count'        =>  Cart::getTotalQuantity(),
                    'payment_status'    =>  0,
                    'payment_method'    =>  null,
                    'name'              =>  $formData['first_name']." ".$formData['last_name'],
                    'address'           =>  $formData['address'],
                    'city'              =>  $formData['city'],
                    'country'           =>  $formData['country'],
                    'post_code'         =>  $formData['post_code'],
                    'phone_number'      =>  $formData['phone_number'],
                    'notes'             =>  $formData['notes'],
                ]);
        
                if ($order) {
        
                    $items = Cart::getContent();
                    $orderItem = [];
                    foreach ($items as $item)
                    {
                        $price_sum = $item->price * $item->quantity;
                        // A better way will be to bring the product id with the cart items
                        $orderItem[] = [
                            'order_id'          =>  $order->id,
                            'product_id'        =>  $item->id,
                            'product_attribute' =>  $item->attributes[0], 
                            'product_variant'   =>  $item->attributes[1],
                            'quantity'          =>  $item->quantity,
                            'price'             =>  $price_sum,
                            'created_at'        =>  now()->toDateTimeString(),
                            'updated_at'        =>  now()->toDateTimeString(),
                        ];
                    }
                    $chunks = array_chunk($orderItem, 500);
                    foreach ($chunks as $chunk) {
                        OrderItem::insert($chunk);
                    }
                }
                Cart::clear();
                $order_details = ['order_no' => $order->order_number, 'name' => $order->name];
                event(new OrderShipped($order));
                $this->SendNotification($order_details);
            }else {
                session()->flash('error', "Your shoping cart is empty!"); 
            }
        }
    }

    public function render()
    {
        $total = 0;
        if (session()->get('buy')) {
            $buy = session()->get('buy');
            $total += $buy[0]['price'] * $buy[0]['quantity'];
        }else {
            $total = Cart::getTotal();
        }
        return view('livewire.user.checkout', [
            'total' => $total,
        ])->extends('user.layouts.user_one');
    }
}
