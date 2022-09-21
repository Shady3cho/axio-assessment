<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Mail\NewWebsitePost;
use App\Models\Post;
use App\Models\PostSubscription;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;


class PostRepository implements PostRepositoryInterface
{

    public function notify(Post $post, bool $retroactive = false)
    {
        $subscriptions = Subscription::withCount('post_subscriptions')
            ->where('website_id', $post->website_id)
            ->Where(function($q) use ($post){
                $q
                    ->orHas('post_subscriptions', 0)
                    ->orWhereDoesntHave('post_subscriptions', function($q) use ($post){
                        $q->where('post_id', 1);
                    });
            })
            ->get()
            ->load('user');

        foreach ($subscriptions as $subscription){
            try{
                Mail::to($subscription->user->email)
                    ->send(
                        new NewWebsitePost($post)
                    );
                PostSubscription::create([
                    'subscription_id' => $subscription->id,
                    'post_id' => $post->id
                ]);
            }catch (\Exception $ex){
            }
        }

        $post->is_sent = true;
        $post->save();

        return $subscriptions;
    }
}
