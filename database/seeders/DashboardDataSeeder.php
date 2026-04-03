<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Deposit;
use App\Models\User;
use Carbon\Carbon;

class DashboardDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        // Xóa data cũ để tránh trùng lặp khi chạy lại
        Order::truncate();
        Deposit::truncate();

        for ($i = 14; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            
            // Random Deposits (Nạp tiền)
            $depositCount = rand(2, 5);
            for ($j = 0; $j < $depositCount; $j++) {
                Deposit::create([
                    'user_id' => $user->id,
                    'amount' => rand(50000, 500000),
                    'payment_method' => 'bank',
                    'transaction_id' => 'TXN' . rand(1000, 9999) . $i . $j,
                    'status' => 'completed',
                    'created_at' => $date->copy()->addHours(rand(0, 23)),
                    'updated_at' => $date
                ]);
            }

            // Random Orders (Đơn hàng)
            $orderCount = rand(10, 30);
            for ($k = 0; $k < $orderCount; $k++) {
                Order::create([
                    'user_id' => $user->id,
                    'service_id' => \Illuminate\Support\Str::ulid(), // Mock service ID
                    'quantity' => rand(100, 1000),
                    'charge' => rand(1000, 20000),
                    'status' => collect(['completed', 'pending', 'processing'])->random(),
                    'created_at' => $date->copy()->addHours(rand(0, 23)),
                    'updated_at' => $date
                ]);
            }
        }
    }
}
