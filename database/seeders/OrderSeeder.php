<?php

namespace Database\Seeders;

use App\Features\Lab\Models\LabTest;
use App\Features\Order\Models\Order;
use App\Features\Payment\Models\InvoiceTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //lab test oreder



        for($i = 0 ; $i < 10 ; $i++ ){
            Order::create([
                'patient_name'          => fake()->name(),
                'coupon_id'             => $coupon = fake()->randomElement([1,2,null]) ,
                'promo_code'            => $coupon == null ? null : fake()->name(),
                'discount_percentage'   => $coupon == null ? null : fake()->numberBetween(1,100),
                'discount_value'        =>  $coupon == null ? null : fake()->numberBetween(100,200),
                'amount'                => fake()->numberBetween(100,200),
                'client_id'             => 1,
                'receiver_id'           => 2,
                'branch_id'             => 3,
                'order_type'            => 'test',
                'visit'                 => fake()->randomElement([1,0]),
                'delivery'              => fake()->randomElement([1,0]),
                'status'                => fake()->randomElement(Order::$statuses),
            ]);
        }

        // radiology xray order
        for($i = 0 ; $i < 10 ; $i++ ){
            Order::create([
                'patient_name'          => fake()->name(),
                'coupon_id'             => $coupon = fake()->randomElement([1,2,null]) ,
                'promo_code'            => $coupon == null ? null : fake()->name(),
                'discount_percentage'   => $coupon == null ? null : fake()->numberBetween(1,100),
                'discount_value'        =>  $coupon == null ? null : fake()->numberBetween(100,200),
                'amount'                => fake()->numberBetween(100,200),
                'client_id'             => 1,
                'receiver_id'           => 2,
                'branch_id'             => 3,
                'order_type'            => 'test',
                'visit'                 => fake()->randomElement([1,0]),
                'delivery'              => fake()->randomElement([1,0]),
                'status'                => fake()->randomElement(Order::$statuses),
            ]);
        }


        // invoice transaction

        $orders = Order::get();

        foreach($orders as $order){
            InvoiceTransaction::create([
                "invoice_id"                     => 39713900,
                "order_id"             => $order->id,
                "payment_method"                 => fake()->randomElement(['Apple Pay (mada)' , 'Visa']),
                "date_operation"                   =>"01122024154951",
                "transaction_status"             => "SUCCESS",
                "invoice_value_in_base_currency"    => "50",
                "base_currency"                  => "SAR",
                "invoice_value_in_pay_currency"     => "50",
                "pay_currency"                   => "SAR"
            ]);
        }
    }
}
