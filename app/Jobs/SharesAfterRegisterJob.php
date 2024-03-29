<?php

namespace App\Jobs;

use App\Models\Member;
use App\Repositories\SharesRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SharesAfterRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $member;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Member $Member)
    {
        $this->member = $Member;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $wallet = $member->wallet;
        $repo = new MemberRepository;
        $repo->repurchasePackage($this->member, $wallet->purchase_point, $wallet);
    }
}
