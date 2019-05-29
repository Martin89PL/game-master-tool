<?php

namespace GameMasterTool\Service;

use GameMasterTool\Entity\Participant;
use GameMasterTool\Repository\ParticipantRepositoryInterface;

class ParticipantService
{
    /**
     * @var ParticipantRepositoryInterface
     */
    private $participantRepository;

    public function __construct(ParticipantRepositoryInterface $participantRepository)
    {
        $this->participantRepository = $participantRepository;
    }

    public function add(string $input)
    {
        $this->participantRepository->save(new Participant());
    }
}