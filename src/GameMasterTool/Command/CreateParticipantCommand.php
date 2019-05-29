<?php

namespace GameMasterTool\Command;

use GameMasterTool\GameState;

class CreateParticipantCommand implements CommandInterface
{
    /**
     * @var GameState
     */
    private $gameState;
    /**
     * @var string
     */
    private $prompt;

    public function __construct(GameState $gameState, string $prompt)
    {
        $this->gameState = $gameState;
        $this->prompt = $prompt;
    }

    public function execute(): void
    {
        $this->gameState->createParticipant($this->prompt);
    }
}
