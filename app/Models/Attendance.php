<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'session_id',
        'date',
    ];

    protected $hidden = [
        'session_id',
        'student_id',
        'updated_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public static function withAll()
    {
        return self::with('student', 'session');
    }
}