<?php

namespace App\Http\Controllers;

use App\Jobs\SendPostNotificationJob;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTimeZone;
use DateTime;

class WebsiteController extends Controller
{
    public function addWebsite(Request $request){

        $validator = Validator::make($request->toArray(), [
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $website = Website::create(
            $request->toArray()
        );

        return response()->json($website);
    }

    public function addPost(Request $request, string $id){

        $validator = Validator::make($request->toArray(), [
            'title' => 'required|min:4|max:255',
            'description' => 'required',
            'scheduled_at' => 'date',
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }

        $website = Website::findOrFail($id);

        $post = $website
            ->posts()
            ->create(
                $request->toArray()
            );



        $delay = 0;
        if($post->scheduled){
            $dt = new DateTime($post->scheduled_at, new DateTimeZone('Africa/Harare'));
            $delay = $dt->getTimestamp() - time();
        }
        $this->dispatch((new SendPostNotificationJob($post))->delay($delay));
        return response()->json($post);
    }
}
