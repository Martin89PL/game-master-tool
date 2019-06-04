<?php

namespace GameMasterTool;

use GameMasterTool\DTO\Prompt;
use GameMasterTool\Service\ParticipantService;

class GameState
{
    /**
     * @var ParticipantService
     */
    private $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }

    public function createParticipant($prompt): void
    {
        $this->participantService->add($prompt);
    }
}
