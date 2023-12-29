<?php

namespace App\Collections;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Carbon\Carbon;
class SoneContent extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'sone_content'; 
    protected $guarded =[];
}