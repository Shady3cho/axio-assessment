<?php

namespace App\Http\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {
    }
    public function addUser(Request $request){

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

        $website = Website::findOrFail($request->website_id);
        $user = User::findOrFail($id);

        $subscription = Subscription::
            create([
                'user_id' => $user->id,
                'website_id' => $website->id,
            ]);

        return response()->json($subscription);
    }

    public function test(Request $request){
        $post = Post::first();
        return $this->postRepository->notify($post);
    }
}
