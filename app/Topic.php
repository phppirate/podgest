<?php

namespace App;

use App\Exceptions\InvalidTopicStatusException;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];
    protected $casts = ['user_id' => 'integer'];

    public static function validateStatus($status)
    {
        $statuses = [
            'accepted',
            'rejected',
            'old',
            null,
        ];

        if (!in_array($status, $statuses)) {
            throw new InvalidTopicStatusException();
        }

        return true;
    }
}
