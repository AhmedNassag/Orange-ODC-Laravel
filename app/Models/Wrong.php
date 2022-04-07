<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wrong extends Model
{
    use HasFactory;
    protected $table   = 'wrongs';
    protected $guarded = [];

    public function question()
    {
        return $this -> belongsTo(Question::class);
    }
}
