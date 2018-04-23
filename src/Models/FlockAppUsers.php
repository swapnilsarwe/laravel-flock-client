<?php

namespace SwapnilSarwe\LaravelFlockClient\Models;

use Illuminate\Database\Eloquent\Model;

class FlockAppUsers extends Model
{
    protected $connection = "flock-app";
    protected $table = 'flock-users';
}
