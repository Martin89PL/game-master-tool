<?php

namespace GameMasterTool\Factory;

use GameMasterTool\Command\CreateParticipantCommand;
use GameMasterTool\Command\CommandInterface;
use GameMasterTool\DTO\PromptDTO;
use GameMasterTool\GameState;

class CommandFactory
{
    public static function create(GameState $gameState, PromptDTO $prompt): CommandInterface
    {
        if ($prompt->offsetExists(0) && $prompt->offsetGet(0) === 'add') {
            return new CreateParticipantCommand($gameState, $prompt);
        }

        throw new \InvalidArgumentException('Bad command!');
    }
}