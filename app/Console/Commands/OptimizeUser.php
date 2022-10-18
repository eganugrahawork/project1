<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OptimizeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:optimizeuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus User Demo dan sebagainya';

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
     * @return int
     */
    public function handle()
    {
        $role = UserRole::where(['role' => 'Demo'])->pluck('id')->first();
        // echo$role;
        $user = User::where(['id_role' => $role])->get();
        foreach($user as $usr){
            $waktu_sekarang = Carbon::now();

            $waktu_dibuat = $usr->created_at;
            $selisih = date_diff($waktu_dibuat, $waktu_sekarang);

                if($selisih->format('%d') > 3){
                    User::where(['id' => $usr->id])->update(['is_expired'=> 1]);
                }
            }



    }
}
