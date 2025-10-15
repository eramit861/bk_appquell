<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionToclient extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_subscription_to_client';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'attorney_id','client_id','package_id','quantity','created_at','updated_at','per_package_price','discount_percentage','discounted_price','package_name'
    ];

}
