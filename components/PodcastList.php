<?php

namespace Cleanse\Podcast\Components;

use Cms\Classes\ComponentBase;
use Cleanse\Podcast\Models\Podcast;

class PodcastList extends ComponentBase
{
    /**
     * @var \Cleanse\Podcast\Models\Podcast The post model used for display.
     */
    public $episodes;

    public function componentDetails()
    {
        return [
            'name'        => 'PvPaissa Podcast List',
            'description' => 'Grabs the podcasts in your database.'
        ];
    }

    public function onRun()
    {
        $this->episodes = $this->page['episodes'] = $this->loadPodcasts();
    }

    protected function loadPodcasts()
    {
        return Podcast::orderBy('created_at', 'desc')->get();
    }
}
