<?php

namespace Arsam\Rmto\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Driver extends Model
{
    use Eloquence, Mappable;

    protected $guarded = [];

    private array $maps = [
        'document_number' => 'doc_number',
        'card_number' => 'no_kart',
        'national_code' => 'code_meli',
        'first_name' => 'name',
        'last_name' => 'family',
        'license_number' => 'shomare_gavahinameh',
        'insurance_number' => 'somare_bime',
    ];
}