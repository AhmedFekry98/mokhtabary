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
                'order_id'              => $order->id,
                'payment_id'            => fake()->numberBetween(1,10),
                'payment_gateway'       => fake()->randomElement(['Apple Pay (mada)' , 'Visa']),
                'transaction_date'      => fake()->dateTime(),
                'transaction_status'    => fake()->randomElement(['SUCCESS' , 'FAILED']),
                'total_service_charge'  => fake()->numberBetween(100,200),
                'due_value'             => fake()->numberBetween(100,200),
                'paid_currency'         => fake()->randomElement(['SAR' , 'USD']),
                'paid_currency_value'   => fake()->numberBetween(100,200),
                'vat_amount'            => fake()->numberBetween(100,200),
                'currency'              => fake()->randomElement(['SAR' , 'USD']),
                'error'                 => fake()->randomElement(['SUCCESS' , 'FAILED']),
            ]);
        }
    }
}
