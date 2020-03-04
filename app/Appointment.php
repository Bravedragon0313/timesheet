<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['task_name', 'person_name', 'start_date', 'end_date', 'user_id','project_name', 'color', 'discipline', 'comments'];
}
