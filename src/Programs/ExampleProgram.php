<?php

namespace Pdazcom\Referrals\Programs;

class ExampleProgram extends AbstractProgram {

    public function reward($rewardObject)
    {
        $this->program->subscription_id = $rewardObject;
        $this->program->save();
    }

}