<?php

use Illuminate\Support\Facades\DB;

function checkAccess($data){

    $result = DB::select("select * from menu_access where menu_id = $data[menu_id] AND role_id = $data[role_id]");

    if($result){
        echo "Checked";
    }else{
        echo "x-circle";
    }
}

function checkPermissionMenuCreate($data){
    $result = DB::select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and created = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuEdit($data){
    $result = DB::select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and edit = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuDelete($data){
    $result = DB::select("select * from crud_permission where role_id = $data[role_id] and menu_id = $data[menu_id] and deleted = 1");

    if($result){
        echo"Checked";
    }
}



?>
