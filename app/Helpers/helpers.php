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
function checkAccessSubmenu($data){
    $result = DB::select("select * from user_access_submenus where id_submenu = $data[id_submenu] and id_role = $data[id_role]");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuCreate($data){
    $result = DB::select("select * from crud_permission where id_role = $data[id_role] and id_menu = $data[id_menu] and created = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuEdit($data){
    $result = DB::select("select * from crud_permission where id_role = $data[id_role] and id_menu = $data[id_menu] and edit = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionMenuDelete($data){
    $result = DB::select("select * from crud_permission where id_role = $data[id_role] and id_menu = $data[id_menu] and deleted = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionSubmenuCreate($data){
    $result = DB::select("select * from crud_permission where id_role = $data[id_role] and id_submenu = $data[id_submenu] and created = 1");

    if($result){
        echo"Checked";
    }
}

function checkPermissionSubmenuEdit($data){
    $result = DB::select("select * from crud_permission where id_role = $data[id_role] and id_submenu = $data[id_submenu] and edit = 1");

    if($result){
        echo"Checked";
    }
}
function checkPermissionSubmenuDelete($data){
    $result = DB::select("select * from crud_permission where id_role = $data[id_role] and id_submenu = $data[id_submenu] and deleted = 1");

    if($result){
        echo"Checked";
    }
}


?>
