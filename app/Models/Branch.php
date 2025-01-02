<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Branch extends Model
{

    protected $table = 'branches';
    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(Service::class, 'branch_id', 'id');
    }
}
