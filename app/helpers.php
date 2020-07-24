<?php

function getUserName($user_id)
{
    $user = App\User::find($user_id);
    return $user->name;
}
