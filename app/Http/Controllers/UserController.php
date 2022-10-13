<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use function PHPUnit\Framework\returnValueMap;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'descp'=>'',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'descp' => $request->get('descp'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }


    public function savelead($request){

        $validator = Validator::make($request->all(), [
            'campaign_id'=>'bail|required|numeric|exists:campaigns,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone'=>'required|digits:10',
            'dob' => 'date_format:d-m-Y',
            'credit_score' =>'sometimes|numeric|nullable|required_if:campaign_id,=,1',
            'heath_conditions'=>'sometimes|required_if:campaign_id,=,2',
            'covid19_exposed'=>'sometimes|boolean|required_if:campaign_id,=,2',
            'existing_insurance'=>'sometimes|required_if:campaign_id,=,2',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $val = Lead::create([
            'campaign_id'=>$request->get('campaign_id'),
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'phone'=>$request->get('phone'),
            'dob'=>$request->get('dob'),
            'credit_score'=>$request->get('credit_score'),
            'health_condition'=>$request->get('health_condition'),
            'covid19_exposed'=>$request->get('covid19_exposed'),
            'existing_insurance'=>$request->get('existing_insurance'),
        ]);

        if($val->save()){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(compact('val'));
        }
    }


    public function getAuthenticatedUser(Request $request)
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return $this->savelead($request);
    }
}
