<?php

use GameMasterTool\Repository\ParticipantRepository;
use GameMasterTool\Service\ParticipantService;

class ParticipantServiceTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testShouldCreateOneParticipant()
    {
        $prompt = 'add participant';

        $participantRepository = new ParticipantRepository();

        $participantService = new ParticipantService($participantRepository);
        $participantService->add($prompt);

        self::assertCount(1, $participantRepository->findAll());
    }
}