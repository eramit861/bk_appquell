<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArgyleAccounts extends Model
{
    protected $table = 'tbl_argyle_accounts';
    public $timestamps = false;
    protected $fillable = [
                            'account_id',
                            'user_id',
                            'employer_name',
                            'token_id',
                            'user_token',
                            'link_item_id',
                            'client_id',
                            'debtor_type',
                            'created_at',
                            'updated_at'
                          ];
}
