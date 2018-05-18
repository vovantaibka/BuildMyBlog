<?php

namespace App\Listeners;

use App\Events\ViewPost;
use Illuminate\Session\Store;

class ViewPostHandler
{
    private $session;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle the event.
     *
     * @param ViewPost $event
     *
     * @return void
     */
    public function handle(ViewPost $event)
    {
        if (!$this->isPostViewed($event->post)) {
            $event->post->increment('views_count');
            $this->storePost($event->post);
        }
    }

    public function isPostViewed($post)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return array_key_exists($post->id, $viewed);
    }

    public function storePost($post)
    {
        $key = 'viewed_posts.'.$post->id;
        $this->session->put($key, time());
    }
}
