<?php

namespace GameMasterTool\Factory;

use GameMasterTool\Command\CreateParticipantCommand;
use GameMasterTool\Command\CommandInterface;
use GameMasterTool\GameState;

class CommandFactory
{
    public static function create(GameState $gameState, string $prompt): CommandInterface
    {
        if (preg_match('/add/i', $prompt)) {
            return new CreateParticipantCommand($gameState, $prompt);
        }

        throw new \InvalidArgumentException('Bad command!');
    }
}