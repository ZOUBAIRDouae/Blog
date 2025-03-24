<?php

namespace Modules\PkgWidget\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Widget extends Model {

    protected $fillable = ['name' , 'method' , 'type'];
}