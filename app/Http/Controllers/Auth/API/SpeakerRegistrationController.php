<?php

namespace App\Http\Controllers\Auth\API;

use App\Models\Speaker;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterSpeakerRequest;
use App\Http\Resources\Simple\SpeakerResource;

/**
 * @author Ibrahim Samad <naatogma@gmail.com>
 */
class SpeakerRegistrationController extends Controller
{
    /**
     * Respond to request
     *
     * @param RegisterSpeakerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterSpeakerRequest $request)
    {
        $input = $request->only('first_name', 'last_name', 'phone_number', 'email', 'location_address', 'city', 'bio');
        $input['password'] = bcrypt($request->input('password'));
        $speaker = Speaker::create($input);
        $tokenObject = $speaker->createToken('al-miftah');
        $token = $tokenObject->accessToken;
        $expiration = Carbon::parse($tokenObject->token->expires_at)->toDateTimeString();
        //TODO: upload avatar if any

        return response()->json([
            'data' => [
                'access_token' => $token,
                'token_type'    => 'Bearer',
                'token_expiration'  => $expiration,
                'speaker'  => new SpeakerResource($speaker)
            ]
        ]);
    }
}
