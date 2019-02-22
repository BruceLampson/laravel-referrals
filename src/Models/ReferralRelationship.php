<?php

namespace Pdazcom\Referrals\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralRelationship extends Model
{
    protected $fillable = ['referral_link_id', 'subscription_id', 'user_id'];
}