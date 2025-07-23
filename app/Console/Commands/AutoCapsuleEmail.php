<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CapsuleEmail;
use App\Models\Capsule;

class AutoCapsuleEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:capsuleemail';

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

        $this->info("⏰ Command triggered at " . now());

        $capsules = Capsule::whereDate('reveal_date', now()->toDateString())
            ->where('is_revealed', 0)
            ->get();


        foreach ($capsules as $capsule) {
            $capsule->is_revealed = 1;
            $capsule->save();

            if ($capsule->user && $capsule->user->email) {
                Mail::to($capsule->user->email)->send(new CapsuleEmail($capsule));
            }
        }

        $this->info("Capsules updated and emails sent");
    }
}
