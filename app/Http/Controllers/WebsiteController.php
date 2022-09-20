<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        return response()->json($post);
    }
}
