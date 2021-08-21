<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

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

    public function sendNotification()
    {
        $firebaseToken = Admin::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('GOOGLE_FIREBASE_SECRET');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'New Order',
                "body" => 'You have a new pending order!',
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
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
        if (Auth::user()->cart->count()>0) {
            if (Arr::exists($formData, 'use_default')) {
                $order = Order::create([
                    'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                    'user_id'           => auth()->user()->id,
                    'status'            =>  'pending',
                    'grand_total'       =>  Auth::user()->cart->sum('price'),
                    'item_count'        =>  Auth::user()->cart->sum('quantity'),
                    'payment_status'    =>  0,
                    'payment_method'    =>  null,
                    'name'              =>  Auth::user()->name,
                    'address'           =>  Auth::user()->address,
                    'city'              =>  Auth::user()->city,
                    'country'           =>  Auth::user()->country,
                    'post_code'         =>  null,
                    'phone_number'      =>  Auth::user()->contact,
                    'notes'             =>  $formData['notes']
                ]);
        
                if ($order) {
        
                    $items = Auth::user()->cart;
        
                    foreach ($items as $item)
                    {
                        $price_sum = $item->price * $item->quantity;
                        // A better way will be to bring the product id with the cart items
                        $orderItem = new OrderItem([
                            'product_id'        =>  $item->product_id,
                            'product_attribute' =>  $item->product_attribute, 
                            'product_variant'   =>  $item->product_variant,
                            'quantity'          =>  $item->quantity,
                            'price'             =>  $price_sum
                        ]);
        
                        $order->items()->save($orderItem);
                    }
                }
                foreach (Auth::user()->cart as $cart) {
                    $cart->delete();
                }
                $this->emit('UpdateCart');
                $this->SendNotification();
            }else {
                // dd($formData);
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
                foreach (Auth::user()->cart as $cart) {
                    $grand_total += $cart->price * $cart->quantity;
                }
                $order = Order::create([
                    'order_number'      =>  'ORD-'.strtoupper(uniqid()),
                    'user_id'           => auth()->user()->id,
                    'status'            =>  'pending',
                    'grand_total'       =>  $grand_total,
                    'item_count'        =>  Auth::user()->cart->sum('quantity'),
                    'payment_status'    =>  0,
                    'payment_method'    =>  null,
                    'name'              =>  $formData['first_name']." ".$formData['last_name'],
                    'address'           =>  $formData['address'],
                    'city'              =>  $formData['city'],
                    'country'           =>  $formData['country'],
                    'post_code'         =>  $formData['post_code'],
                    'phone_number'      =>  $formData['phone_number'],
                    'notes'             =>  $formData['notes']
                ]);
        
                if ($order) {
        
                    $items = Auth::user()->cart;
        
                    foreach ($items as $item)
                    {
                        $price_sum = $item->price * $item->quantity;
                        // A better way will be to bring the product id with the cart items
                        $orderItem = new OrderItem([
                            'product_id'        =>  $item->product_id,
                            'product_attribute' =>  $item->product_attribute, 
                            'product_variant'   =>  $item->product_variant,
                            'quantity'          =>  $item->quantity,
                            'price'             =>  $price_sum
                        ]);
        
                        $order->items()->save($orderItem);
                    }
                }
                foreach (Auth::user()->cart as $cart) {
                    $cart->delete();
                }
                $this->emit('UpdateCart');
                $this->SendNotification();
            }
        }else {
            session()->flash('error', "Your shoping cart is empty!"); 
        }
    }

    public function render()
    {
        $total = 0;
        foreach (Auth::user()->cart as $cart) {
            $total += $cart['price'] * $cart['quantity'];
        }
        return view('livewire.user.checkout', [
            'cart' => Auth::user()->cart,
            'total' => $total,
        ])->extends('user.layouts.user_one');
    }
}
