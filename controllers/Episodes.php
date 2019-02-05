<?php

namespace Cleanse\Podcast\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Cleanse\Podcast\Models\Podcast;

class Episodes extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['cleanse.podcast.manage_podcast'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Cleanse.Podcast', 'podcast', 'new_episode');
    }

    public function index()
    {
        $this->vars['podcastsTotal'] = Podcast::count();

        $this->asExtension('ListController')->index();
    }

    public function create()
    {
        BackendMenu::setContextSideMenu('new_episode');

        $this->bodyClass = 'compact-container';

        return $this->asExtension('FormController')->create();
    }

    public function update($recordId = null)
    {
        $this->bodyClass = 'compact-container';

        return $this->asExtension('FormController')->update($recordId);
    }
}
