<?php
/**
 * Created by PhpStorm.
 * User: swapnils
 * Date: 09/02/18
 * Time: 1:07 AM
 */

namespace SwapnilSarwe\LaravelFlockClient\Repositories;


use SwapnilSarwe\LaravelFlockClient\Models\FlockAppUsers;

class FlockAppRepository
{
    public function install($params)
    {
        $flockUser = FlockAppUsers::where('user_id', '=', array_get($params, 'userId'))->first();
        if (is_null($flockUser)) {
            $flockUser = new FlockAppUsers();
        }
        $flockUser->user_id = array_get($params, 'userId');
        $flockUser->user_token = array_get($params, 'userToken');
        $flockUser->is_installed = 1;
        return $flockUser->save();
    }

    public function uninstall($params)
    {
        $flockUser = $this->getUserDetails(array_get($params, 'userId')); //FlockAppUsers::where('user_id', '=', array_get($params, 'userId'))->first();
        $flockUser->is_installed = false;
        return $flockUser->save();
    }

    public function getUserDetails($userId)
    {
        return FlockAppUsers::where('user_id', '=', $userId)->first();
    }
}