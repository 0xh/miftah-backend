<?php  

namespace App\Observers;

use App\Topic;


class TopicObserver
{
    public function creating(Topic $topic)
    {
        $topic->slug = str_slug($topic->title);
    }

    public function updating(Topic $topic)
    {
        $topic->slug = str_slug($topic->title);
    }
}
