<?php

namespace Cleanse\Podcast\Components;

use Cms\Classes\ComponentBase;
use Cleanse\Podcast\Models\Podcast;

class Latest extends ComponentBase
{
    public $podcast;

    public function componentDetails()
    {
        return [
            'name'        => 'PvPaissa Last Podcast',
            'description' => 'Grabs the latest podcast for widget.'
        ];
    }

    public function onRun()
    {
        $this->podcast = $this->page['podcast'] = $this->loadPodcast();
    }

    protected function loadPodcast()
    {
        return Podcast::orderBy('created_at', 'desc')->first();
    }
}
