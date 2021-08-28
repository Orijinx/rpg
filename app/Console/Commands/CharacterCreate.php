<?php

namespace App\Console\Commands;

use App\Models\Character;
use App\Models\Room;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CharacterCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'character:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает нового персонажа';

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
        $character = new Character();
        $character->name = $this->ask("Как вас зовут?");
        $character->race = $this->ask("Какая у вас раса?");
        $role = $this->ask("Выберите класс: Воин(1),Маг(2),Вор(3) (Default:Воин)");
        switch ((int)$role) {
            case 1: {
                    $character->role = "warrior";
                    $character->mind = random_int(0, 1);
                    $character->strength = random_int(2, 4);
                    $character->agility = random_int(1, 2);
                }
            case 2:
                $character->role = "mage";
                $character->mind = random_int(2, 4);
                $character->strength = random_int(0, 1);
                $character->agility = random_int(1, 2);
            case 3:
                $character->role = "thief";
                $character->mind = random_int(1, 3);
                $character->strength = random_int(1, 3);
                $character->agility = random_int(1, 3);
            default:
                $character->role = "warrior";
                $character->mind = random_int(0, 1);
                $character->strength = random_int(2, 4);
                $character->agility = random_int(1, 2);
        }

      while (true) {
            $room = $this->ask("Введите ключ игровой комнаты:");
            if (DB::table("rooms")->where("key", $room)->exists()) {
                $character->room_id = Room::where("key",$room)->first()->id;
                break;
            }else{
                $this->info("Такой комнаты не существует!");
            }
        }
        $character->save();
        $this->info("Персонаж успешно создан!\n");
        $this->info("На свет появился:" . $character->name .
        "\nОн(а) из расы:" . $character->race .
        "\nИ имеет класс:" . $character->role .
        "\nВрожденные характеристики: Int-" . $character->mind . " Str-" . $character->strength . " Ag-" . $character->agility);
    
        return 0;
    }
}
