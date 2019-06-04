<?php

namespace GameMasterTool\ValueObject;

use GameMasterTool\DTO\Prompt;

class CreateParticipant
{
    private $participantsProps = [];

    public function __construct(Prompt $prompt)
    {
        $this->name = sprintf('%s %s',$prompt->offsetGet(1),$prompt->offsetGet(2));
        $this->PHY = $prompt->offsetGet($prompt->getIndexByValue('PHY') - 1);
        $this->MEN = $prompt->offsetGet($prompt->getIndexByValue('MEN') - 1);
        $this->VIT = $prompt->offsetGet($prompt->getIndexByValue('VIT') - 1);
        $this->LUC = $prompt->offsetGet($prompt->getIndexByValue('LUC') - 1);
        $this->skill1 = $prompt->offsetGet($prompt->count() - 2);
        $this->skill2 = $prompt->offsetGet($prompt->count() - 1);
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
