<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applications extends Model
{
    use HasFactory, SoftDeletes;

    public function status() {
        return $this->hasOne(ApplicationStatus::class, 'application_id', 'id');
    }

    public function references() {
        return $this->hasMany(References::class, 'application_id', 'id');
    }

    public function coapplicants() {
        return $this->hasMany(CoApplicantDetails::class, 'application_id', 'id');
    }

    public function vehicle() {
        return $this->hasOne(Vehicles::class, 'application_id', 'id');
    }

}
