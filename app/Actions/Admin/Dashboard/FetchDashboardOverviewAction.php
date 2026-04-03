<?php

namespace App\Actions\Admin\Dashboard;

use App\Models\Deposit;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

/**
 * Chỉ số tổng quan console admin (member, đơn, nạp, biểu đồ).
 */
class FetchDashboardOverviewAction
{
    /**
     * @return array{
     *   totalMembers: int,
     *   todayMembers: int,
     *   totalOrders: int,
     *   pendingOrders: int,
     *   totalEarnings: float,
     *   todayEarnings: float,
     *   chartLabels: list<string>,
     *   depositItems: list<float>,
     *   orderItems: list<int>
     * }
     */
    public function execute(): array
    {
        $totalMembers = User::count();
        $todayMembers = User::whereDate('created_at', Carbon::today())->count();

        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();

        $totalEarnings = (float) Deposit::where('status', 'completed')->sum('amount');
        $todayEarnings = (float) Deposit::where('status', 'completed')
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        $chartLabels = [];
        $depositItems = [];
        $orderItems = [];

        for ($i = 14; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->format('d/m');

            $depositItems[] = (float) Deposit::where('status', 'completed')
                ->whereDate('created_at', $date)
                ->sum('amount');

            $orderItems[] = Order::whereDate('created_at', $date)->count();
        }

        return [
            'totalMembers' => $totalMembers,
            'todayMembers' => $todayMembers,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'totalEarnings' => $totalEarnings,
            'todayEarnings' => $todayEarnings,
            'chartLabels' => $chartLabels,
            'depositItems' => $depositItems,
            'orderItems' => $orderItems,
        ];
    }
}
