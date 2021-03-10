<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\MemberFreezeShares;

class FreezeSharesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shares:freeze';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unfreeze shares.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $carbon = Carbon::now();
        $today = $carbon->toDateString();
        MemberFreezeShares::where('has_process', 0)
            ->where('active_date', '<=', $today)
            ->chunk(100, function ($shares) {
            foreach ($shares as $share) {
                $member = $share->member;
                $shareWallet = $member->shares;
                $shareWallet->amount += $share->amount;
                $shareWallet->save();
                $share->has_process = true;
                $share->save();
            }
        });
    }
}
