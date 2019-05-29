<?php

namespace GameMasterTool;

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

    public function createParticipant(string $prompt): void
    {
        $this->participantService->add($prompt);
    }
}
