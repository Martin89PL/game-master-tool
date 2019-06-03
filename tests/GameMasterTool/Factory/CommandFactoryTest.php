<?php

use GameMasterTool\Command\CreateParticipantCommand;
use GameMasterTool\DTO\PromptDTO;
use GameMasterTool\Factory\CommandFactory;
use GameMasterTool\GameState;

class CommandFactoryTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testShouldReturnAddParticipantCommand()
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject | \GameMasterTool\Service\ParticipantService $participantService */
        $participantService = self::createMock(\GameMasterTool\Service\ParticipantService::class);
        $gameState = new GameState($participantService);
        $addParticipantCommand = CommandFactory::create($gameState, new PromptDTO('add ParticipantName x PHY x MEN x VIT x LUC Skill1 Skill2'));
        self::assertInstanceOf(CreateParticipantCommand::class, $addParticipantCommand);
    }

    public function testShouldThrowExceptionWhenCommandIsBad()
    {
        self::expectException(InvalidArgumentException::class);

        /** @var \PHPUnit\Framework\MockObject\MockObject | \GameMasterTool\Service\ParticipantService $participantService */
        $participantService = self::createMock(\GameMasterTool\Service\ParticipantService::class);
        $gameState = new GameState($participantService);
        CommandFactory::create($gameState, new PromptDTO('bad command'));
    }
}
