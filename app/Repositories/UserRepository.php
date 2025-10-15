<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getUserWithClientsAttorneyIdName($id)
    {
        return User::where('id', $id)->with(['ClientsAttorneybyclient','ClientsAttorneybyattorney','ClientsAttorneybyclient.getuserattorney'])->first();
        ;


    }
}
