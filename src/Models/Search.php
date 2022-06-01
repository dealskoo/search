<?php

namespace Dealskoo\Search\Models;

use Dealskoo\Country\Traits\HasCountry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory, HasCountry;

    protected $fillable = [
        'name',
        'country_id'
    ];
}
