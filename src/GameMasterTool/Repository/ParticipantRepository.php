<?php

namespace GameMasterTool\Repository;

use GameMasterTool\Entity\Participant;

class ParticipantRepository implements ParticipantRepositoryInterface
{
    /** @var Participant[] */
    private $participants = [];

    public function save(Participant $participant): void
    {
        $this->participants[] = $participant;
    }

    public function findOneById(string $id): Participant
    {
        // TODO: Implement findOneById() method.
    }
}
