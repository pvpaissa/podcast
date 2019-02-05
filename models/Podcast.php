<?php

namespace Cleanse\Podcast\Models;

use Model;

/**
 * Class Podcast
 * @package Cleanse\Podcast\Models
 *
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $link
 * @property string $image
 */
class Podcast extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var string
     */
    public $table = 'cleanse_podcasts';

    /**
     * @var array
     */
    public $attachOne = [
        'image' => ['System\Models\File']
    ];

    /**
     * @var array Generate slug for the title attribute.
     */
    protected $slugs = ['slug' => 'title'];

    /**
     * Returns the public image file path to this user's avatar.
     * @param integer $size
     * @param array $options
     *
     * @return string
     */
    public function getAvatarThumb($size = 400, $options = null)
    {
        if (is_string($options)) {
            $options = ['default' => $options];
        }
        elseif (!is_array($options)) {
            $options = [];
        }

        if ($this->image) {
            return $this->image->getThumb($size, $size, $options);
        } else {
            return '/plugins/cleanse/news/assets/images/default-article.jpg';
        }
    }
}
