<?php

namespace App\Traits\Models;

/**
 * Trait Sluggable
 *
 * @author Roman Sarvarov <roman.sarvarov@gmail.com>
 */
trait Sluggable
{
    public function generateUniqueSlug($slug)
    {
        $original = $slug;
        $count = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = "{$original}-" . $count++;
        }

        return $slug;
    }
}
