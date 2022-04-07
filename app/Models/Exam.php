<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $table   = 'exams';
    protected $guarded = [];

    public function course()
    {
        return $this -> belongsTo(Course::class);
    }

    public function questions()
    {
        return $this -> hasMany(Question::class);
    }

    public function revisions()
    {
        return $this -> hasMany(Revision::class);
    }
}
