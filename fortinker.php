<?php
// Run this:
$user = new App\User;
$user->name = "bestmanager";
$user->email = "bestmanager@me.com";
$user->password = Hash::make('123456');
$user->save();
$rights = new App\Rights;
$rights->id_user = 1;
$rights->rights = 'manager';
$rights->save();
exit;