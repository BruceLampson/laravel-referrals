<?php

namespace Pdazcom\Referrals\Http\Middleware;

use Illuminate\Http\Request;
use Pdazcom\Referrals\Models\ReferralLink;
use Pdazcom\Referrals\Models\ReferralProgram;

/**
 * Class StoreReferralCode
 * @package Pdazcom\Referrals\Http\Middleware
 */
class StoreReferralCode {

    public function handle(Request $request, \Closure $next)
    {
        if ($request->has('ref')){
            $referral = ReferralLink::whereCode($request->get('ref'))->first();
            if($referral){
                $program = $referral->program()->first();
                return redirect($request->url())->cookie('ref', $referral->id, $program->lifetime_minutes);
            }
            \Log::warn('Referral Ref code not found where request.ref equals '.$request->has('ref'));
        }
        return $next($request);
    }
}
