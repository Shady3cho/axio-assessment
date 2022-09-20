<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function postUser(Request $request){

        $validator = Validator::make($request->toArray(), [
            'email' => 'email'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $user = User::create(
            ['email' => $request->email]
        );

        return response()->json($user);
    }

    public function subscribe(Request $request, string $id){

        $website = Website::findOrFail($id);
        $user = User::findOrFail($request->user_id);

        $subscription = $website
            ->subscriptions()
            ->create([
                'user_id' => $user->id
            ]);

        return response()->json($subscription);
    }
}
