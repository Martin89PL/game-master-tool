<?php

namespace GameMasterTool\Command;

use GameMasterTool\DTO\PromptDTO;
use GameMasterTool\GameState;

class CreateParticipantCommand implements CommandInterface
{
    /**
     * @var GameState
     */
    private $gameState;

    /**
     * @var PromptDTO
     */
    private $prompt;

    public function __construct(GameState $gameState, PromptDTO $prompt)
    {
        $this->gameState = $gameState;
        $this->prompt = $prompt;
    }

    public function execute(): void
    {
        $this->gameState->createParticipant($this->prompt);
    }
}
