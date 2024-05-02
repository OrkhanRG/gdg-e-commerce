<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\UserWelcomeNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SendMailVerifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:send-mail {user} {--Q|queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Doğrulama Emaili göndərmək üçün';


    /**
     * Execute the console command.
     */
    public function handle()
    {
//        dd($this->argument('user'), $this->option('queue'));

        /*$this->table(
            ['Name', 'Email'],
            User::query()->select('name', 'email')->get()
        );*/

        $unverifedUser = User::query()
            ->whereNull('email_verified_at')
            ->get();

        foreach ($unverifedUser as $user)
        {
            $token = Str::random(40);
            Cache::put('verify_token_'.$token,$user->id, 3600);

            $user->notify(new UserWelcomeNotification($token));
        }
    }
}
