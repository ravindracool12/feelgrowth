<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use App\Repositories\BonusRepository;

class BonusPairingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonus:pairing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Pairing Daily';

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
        Member::where('left_total', '>=', 500)->where('right_total', '>=', 500)->chunk(100, function ($members) use ($repo) {
            foreach ($members as $member) {
                $repo->calculatePairing($member);
            }
        });
    }
}
