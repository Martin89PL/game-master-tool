<?php

namespace GameMasterTool\VO;

use GameMasterTool\DTO\PromptDTO;

class AddParticipant
{
    private $participantsProps = [];

    public function __construct(PromptDTO $prompt)
    {
        $prompt->offsetUnset(0);
        $this->PHY = $prompt->offsetGet($prompt->getIndexByValue('PHY') - 1);
        $this->MEN = $prompt->offsetGet($prompt->getIndexByValue('MEN') - 1);
        $this->VIT = $prompt->offsetGet($prompt->getIndexByValue('VIT') - 1);
        $this->LUC = $prompt->offsetGet($prompt->getIndexByValue('LUC') - 1);
    }

    public function __set($name, $value)
    {
        $this->participantsProps[$name] = $value;
    }

    public function __get($name)
    {
        return $this->participantsProps[$name];
    }
}
