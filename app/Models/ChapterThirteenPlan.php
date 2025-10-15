<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterThirteenPlan extends Model
{
    protected $table = 'tbl_chapter_thirteen_plan';
    protected $fillable = [
        'client_id','plan_data','plan_step_ups'
    ];
}
