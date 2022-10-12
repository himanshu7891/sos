<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    public function team() {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
    public function branch() {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
}
