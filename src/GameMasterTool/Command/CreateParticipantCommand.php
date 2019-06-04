<?php

namespace GameMasterTool\Command;

use GameMasterTool\DTO\Prompt;
use GameMasterTool\GameState;

class CreateParticipantCommand implements CommandInterface
{
    /**
     * @var GameState
     */
    private $gameState;

    /**
     * @var Prompt
     */
    private $prompt;

    public function __construct(GameState $gameState, Prompt $prompt)
    {
        $this->gameState = $gameState;
        $this->prompt = $prompt;
    }

    public function execute(): void
    {
        $this->gameState->createParticipant($this->prompt);
    }
}
