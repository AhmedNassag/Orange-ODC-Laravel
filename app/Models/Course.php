<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table   = 'courses';
    protected $guarded = [];

    /*
     * the relation between courses & users
     * the users has many users 
     */
    public function users()
    {
        return $this -> hasMany(User::class,'enroll','course_id','user_id','id','id');
    }

    /*
     * the relation between courses & trainers
     * the users has many trainers 
     */
    public function trainers()
    {
        return $this -> hasMany(Trainer::class);
    }

    /*
     * the relation between users & courses
     * the courses belongs to category 
     */
    public function category()
    {
        return $this -> belongsTo(Category::class);
    }

    /*
     * the relation between courses & courses
     * the courses belongs to category 
     */
    public function exams()
    {
        return $this -> hasMany(Exam::class);
    }
}
