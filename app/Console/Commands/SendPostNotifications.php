<?php

namespace App\Console\Commands;

use App\Interfaces\PostRepositoryInterface;
use App\Jobs\SendPostNotificationJob;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Console\Command;

class SendPostNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post-notifications:send {--include_future}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out notifications for posts that have not been sent yet.';

    public function __construct(private PostRepositoryInterface $postRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->info('gathering posts...');
        $query = Post::where('is_sent', false);

        if($this->option('include_future')){
            $query = $query
                ->where('scheduled_at', '<=', now())
                ->orWhere('scheduled_at', null);
        }

        $posts = $query->get();

        foreach ($posts as $post){
            $this->postRepository->notify($post);
            $this->info("post : $post->id sent....");
        }

        $this->info('Done');
        return '';
    }
}
