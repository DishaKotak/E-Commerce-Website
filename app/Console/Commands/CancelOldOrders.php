<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class CancelOldOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cancel-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('status', 'pending')
        ->where('created_at', '<', now()->subHours(24))
        ->get();

        foreach($orders as $order) {
            $order->status = 'cancelled';
            $order->save();
        }
    }
}
