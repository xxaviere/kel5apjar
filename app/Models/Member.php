<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['nama', 'nim','konsentrasi','judul','proposal','pembimbing','status','action'];
    use HasFactory;
}
