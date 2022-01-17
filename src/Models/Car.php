<?php

namespace Arsam\Rmto\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Car extends Model
{
    use Eloquence, Mappable;

    protected $guarded = [];

    private array $maps = [];

}