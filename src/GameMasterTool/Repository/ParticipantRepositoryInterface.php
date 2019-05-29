<?php

namespace GameMasterTool\Repository;

use GameMasterTool\Entity\Participant;

interface ParticipantRepositoryInterface
{
    public function save(Participant $participant): void;

    public function findOneById(string $id): Participant;
}