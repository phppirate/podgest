<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\InvalidTopicStatusException;

class Topic extends Model
{
    protected $guarded = [];

    static function validateStatus($status)
    {
    	$statuses = [
    		'accepted',
    		'rejected',
    		'old',
    		null
		];

    	if(! in_array($status, $statuses)){
    		throw new InvalidTopicStatusException();
		}

		return true;
    }
}
