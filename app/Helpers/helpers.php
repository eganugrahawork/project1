<?php

use Illuminate\Support\Facades\DB;

function checkAccess($data){

    $result = DB::select("select * from user_access_menus where id_menu = $data[id_menu] AND id_role = $data[id_role]");

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
?>
