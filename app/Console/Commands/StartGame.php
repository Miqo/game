<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'StartGame';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is run game command';

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
     * Team members count
     * @var intager
     */
    private $teamMembersCount = 5;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $teamA = $this->validateTeamValues($this->ask("Enter Team A members level"));
        $teamB = $this->validateTeamValues($this->ask("Enter Team B members level"));

        $result = ($this->compareTeamsLevel($teamA, $teamB)) ? "TeamA Win" : "TeamA Lose" ;
        $this->info($result);
    }

    /**
     * Validation for Team members input values
     * @param $team - input values
     * @return array
     */
    private function validateTeamValues($team) {
        $team = explode(',', $team);
        if(count($team) != $this->teamMembersCount || $team === null) {
            $this->error("You must write not more 5 intagers separated by a comma. Example: 30, 100, 20, 50, 40");
            exit();
        }

        if(!empty($team)){
            foreach ($team as $value) {
                if(!is_numeric($value)) {
                    $this->error("You must write only intagers!");
                    exit();
                }
            }
        }

        return $team;
    }

    /**
     * Compare teams level and return result true if teamA can win
     * @param $teamA - teamA level array
     * @param $teamB - teamB level array
     * @return bool
     */
    private function compareTeamsLevel($teamA, $teamB) {
        $teamAwin = true;
        for ($i = 0; count($teamA) > $i; $i++) {
           if($teamA[$i] < $teamB[$i]) {
                $teamAwin = false;
           }
        }
        return $teamAwin;
    }
}
