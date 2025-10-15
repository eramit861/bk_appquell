<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_forms';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'form_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['form_name','zipcode','form_tab','sorting_order','file_name',"is_active","is_uppliment",'form_tab_description','form_tab_content','type','chapter_type','trustee'];
}
