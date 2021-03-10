<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Carbon\Carbon;
use App\Repositories\BonusRepository;

class BonusGroupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonus:group';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Group Daily';

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
        $repo = new BonusRepository;
        $today = Carbon::now();
        Member::where('is_group_bonus', 1)->chunk(100, function ($members) use ($repo) {
            foreach ($members as $member) {
                $repo->calculateGroup($member);
            }
        });
    }
}
