<?php

namespace App\Console\Commands;

use App\Entities\User;
use Illuminate\Console\Command;

class RoleManageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:set-admin {user_id} {role_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign role to user';

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
        $user = User::findOrFail($this->argument('user_id'));
        $user->assignRole($this->argument('role_id'));
        $this->output->success('Success');
    }
}
