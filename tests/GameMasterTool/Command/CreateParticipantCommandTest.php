<?php

use GameMasterTool\Command\CreateParticipantCommand;

class CreateParticipantCommandTest extends \Codeception\Test\Unit
{

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testShouldCheckIsMethodCreateParticipantIsCalled()
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject | \GameMasterTool\GameState $gameStateMock */
        $gameStateMock = self::createMock(\GameMasterTool\GameState::class);
        $gameStateMock->expects(self::once())->method('createParticipant');

        $createParticipantCommand = new CreateParticipantCommand($gameStateMock, new \GameMasterTool\DTO\PromptDTO('add participant'));
        $createParticipantCommand->execute();
    }
}