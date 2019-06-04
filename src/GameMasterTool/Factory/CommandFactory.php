<?php

namespace GameMasterTool\Factory;

use GameMasterTool\Command\CreateParticipantCommand;
use GameMasterTool\Command\CommandInterface;
use GameMasterTool\DTO\Prompt;
use GameMasterTool\GameState;
use GameMasterTool\ValueObject\CreateParticipant;

class CommandFactory
{
    public static function create(GameState $gameState, Prompt $prompt): CommandInterface
    {
        if ($prompt->offsetExists(0) && $prompt->offsetGet(0) === 'add') {
            return new CreateParticipantCommand($gameState, $prompt);
        }

        throw new \InvalidArgumentException('Bad command!');
    }
}