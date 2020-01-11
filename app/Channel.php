<?php
// phpcs:ignoreFile
namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * Get route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
