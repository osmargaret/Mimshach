<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'level_of_education',
        'programme_of_interest',
        'preferred_countries',
        'tuition_budget',
    ];

    protected $casts = [
        'programme_of_interest' => 'array',
        'preferred_countries' => 'array',
    ];

    public function setProgrammeOfInterestAttribute($value)
    {
        $this->attributes['programme_of_interest'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setPreferredCountriesAttribute($value)
    {
        $this->attributes['preferred_countries'] = is_array($value) ? json_encode($value) : $value;
    }
}
