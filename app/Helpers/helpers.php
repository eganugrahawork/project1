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

?>
