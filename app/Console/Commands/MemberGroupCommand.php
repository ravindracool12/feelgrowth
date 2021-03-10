<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;

class MemberGroupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:group';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if member is qualified for group bonus.';

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
        $model = new Member;
        Member::where('is_group_bonus', 0)->chunk(100, function ($members) use ($model) {
            foreach ($members as $member) {
                // check if member qualified
                $left = explode(',', $member->left_children);
                $right = explode(',', $member->right_children);
                $checkLeft = $model->whereIn('id', $left)->where('direct_id', $member->id)->first();
                $checkRight = $model->whereIn('id', $right)->where('direct_id', $member->id)->first();
            
                if ($checkLeft && $checkRight) { // qualified
                    $member->is_group_bonus = true;
                    $member->save();
                }
            }
        });
    }
}
