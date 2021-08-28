<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;

class RoomCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'room:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает новую комнату';

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
        $room = new Room();
        $room->key = hash('ripemd160', (string)random_int(1,1000));
        $room->save();
        $this->info("Success!\nKey:".$room->key);
        return 0;
    }
}
