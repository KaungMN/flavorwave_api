<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'McKenzie Group', 'password' => 'test1234', 'email' => 'user@gmail.com', 'city' => 'Yangon', 'township' => 'Yankin', 'address' => 'abcRoad', 'phone' => '0958439574', 'customerType' => 'Key Account'],
            ['name' => 'Savory Delights', 'password' => 'test1234', 'email' => 'deligiht@gmail.com', 'city' => 'Yangon', 'township' => 'Thuwunna', 'address' => 'Merchant Street', 'phone' => '0974369574', 'customerType' => 'Key Account'],
            ['name' => 'Vandervort Inc', 'password' => '85403', 'email' => 'van@gmail.com', 'city' => 'Mandalay', 'township' => 'Mandalay', 'address' => '45th street', 'phone' => '0957436574', 'customerType' => 'Whole Sale'],
            ['name' => 'Spicy Inc', 'password' => '75473', 'email' => 'spicy@gmail.com', 'city' => 'Sagaing', 'township' => 'Sagaing', 'address' => 'Mandalay Street', 'phone' => '0958439574', 'customerType' => 'Whole Sale'],
            ['name' => 'Daniel Inc Group', 'password' => 'test1234', 'email' => 'daniel@gmail.com', 'city' => 'Yangon', 'township' => 'Yankin', 'address' => 'abcRoad', 'phone' => '0985349578', 'customerType' => 'Distributor'],
            ['name' => 'LynchO', 'password' => 'test@1234', 'email' => 'lync@gmail.com', 'city' => 'Yangon', 'township' => 'Lanmadaw', 'address' => 'bccRoad', 'phone' => '0954737284', 'customerType' => 'Key Account'],
            ['name' => 'Marks and Sons', 'password' => 'helloworld123', 'email' => 'mark@gmail.com', 'city' => 'Yangon', 'township' => 'Yankin', 'address' => 'abcRoad', 'phone' => '0958439574', 'customerType' => 'Distributor'],
            ['name' => 'Hane and Sons', 'password' => 'hihello@123', 'email' => 'hane@gmail.com', 'city' => 'Yangon', 'township' => 'Yankin', 'address' => 'bbRoad', 'phone' => '096688799574', 'customerType' => 'Key Account'],
            ['name' => 'McKenz', 'password' => 'abcde12344', 'email' => 'mc@gmail.com', 'city' => 'Yangon', 'township' => 'Yankin', 'address' => 'abcRoad', 'phone' => '09556743865574', 'customerType' => 'Distributor'],
            ['name' => 'Mce Group', 'password' => 'mce1234', 'email' => 'mce@gmail.com', 'city' => 'Mandalay', 'township' => 'Mandalay', 'address' => 'Mandalay', 'phone' => '0954738547', 'customerType' => 'Key Account'],
            ['name' => 'McKenzie Group', 'password' => '8439754', 'email' => 'user@gmail.com', 'city' => 'Yangon', 'township' => 'Yankin', 'address' => 'abcRoad', 'phone' => '0958439574', 'customerType' => 'Whole sale'],
        ];

        foreach ($customers as $customer) {
            Customer::create([
                'name' => $customer['name'],
                'password' => Hash::make($customer['password']),
                'email' => $customer['email'],
                'city' => $customer['city'],
                'township' => $customer['township'],
                'address' => $customer['address'],
                'phone' => $customer['phone'],
                'customerType' => $customer['customerType'],
            ]);
        }
    }
}
