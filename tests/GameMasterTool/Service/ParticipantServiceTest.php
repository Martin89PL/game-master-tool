<?php

use GameMasterTool\DTO\Prompt;
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
        $participantRepository = new ParticipantRepository();
        $participantService = new ParticipantService($participantRepository);
        $participantService->add(new Prompt('test'));

        self::assertCount(1, $participantRepository->findAll());
    }
}