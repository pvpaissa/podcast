<?php

namespace Cleanse\Podcast;

use Backend;
use Controller;
use System\Classes\PluginBase;
use Cleanse\Podcast\Models\Podcast;

/**
 * Podcast Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Podcast',
            'description' => 'Add a podcast list to your website.',
            'author'      => 'Paul Lovato',
            'icon'        => 'icon-microphone'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Cleanse\Podcast\Components\PodcastList'    => 'cleansePodcastList'
        ];
    }

    public function registerPermissions()
    {
        return [
            'cleanse.podcast.manage_podcast' => [
                'tab'   => 'Podcast',
                'label' => 'Manage Podcast'
            ]
        ];
    }

    public function registerNavigation()
    {
        return [
            'podcast' => [
                'label'       => 'Podcast',
                'url'         => Backend::url('cleanse/podcast/episodes'),
                'icon'        => 'microphone',
                'iconSvg'     => 'plugins/cleanse/podcast/assets/images/podcast.svg',
                'permissions' => ['cleanse.podcast.*'],
                'order'       => 43,

                'sideMenu' => [
                    'episodes' => [
                        'label'       => 'Podcast List',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('cleanse/podcast/episodes'),
                        'permissions' => ['cleanse.podcast.manage_podcast']
                    ],
                    'new_episode' => [
                        'label'       => 'New Podcast',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('cleanse/podcast/episodes/create'),
                        'permissions' => ['cleanse.podcast.manage_podcast']
                    ]
                ]
            ]
        ];
    }

    public function boot()
    {
        \Event::listen('offline.sitesearch.query', function ($query) {

            $items = Podcast::where('description', 'like', "%${query}%")
                ->get();

            $results = $items->map(function ($item) use ($query) {

                $relevance = mb_stripos($item->name, $query) !== false ? 2 : 1;

                return [
                    'title'     => $item->title,
                    'text'      => $item->description,
                    'url'       => $item->url,
                    'relevance' => $relevance,
                ];
            });

            return [
                'provider' => 'Podcast',
                'results'  => $results,
            ];
        });
    }
}
