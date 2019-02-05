<?php

namespace Cleanse\Podcast\Components;

use Cms\Classes\ComponentBase;
use Cleanse\Podcast\Models\Podcast;

class Episode extends ComponentBase
{
    /**
     * @var \Cleanse\Podcast\Models\Podcast The post model used for display.
     */
    public $episode;

    public function componentDetails()
    {
        return [
            'name'        => 'PvPaissa Podcast Episode',
            'description' => 'Grabs the podcasts in your database.'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'Episode slug',
                'description' => 'Look up the episode using the supplied slug value.',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->episode = $this->page['episode'] = $this->loadPodcast();
    }

    protected function loadPodcast()
    {
        $slug = $this->property('slug');

        return Podcast::where('slug', $slug)->first();
    }
}
