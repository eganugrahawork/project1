<?php
namespace App\Http\Controllers\Admin\Configuration;

use App\Http\Controllers\Controller;
use App\Models\SeenActivities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ConfigurationController extends Controller
{
    public function useractivity() {

        return view('admin.configuration.useractivity.index');
    }

    public function listuseractivity() {
        $activity = DB::connection('masterdata')->select('SELECT a.created_at, a.menu, a.aktivitas, a.keterangan, b.name, b.username, b.image FROM user_activities a JOIN users b ON a.id_user = b.id ORDER BY a.id DESC');

        return  Datatables::of($activity)->addIndexColumn()->addColumn('usernya', function ($model) {
            $url = url('storage/' . $model->image);
            $user = "<div class='symbol symbol-circle symbol-50px overflow-hidden me-3'>
            <a href='#'>
                <div class='symbol-label'>
                    <img src='$url' alt='' class='w-100' />
                </div>
            </a>
        </div>
        <div class='d-flex flex-column'>
            <a href='#' class='text-gray-800 text-hover-primary mb-1'>$model->name</a>
            <span>$model->username</span>
        </div>";
            return $user;
        })->rawColumns(['usernya'])->make(true);
    }

    public function checknotification() {
        $inUser = auth()->user()->id;
        $ini = DB::connection('masterdata')->select("SELECT  *
        FROM    user_activities a
        WHERE   NOT EXISTS
                (
                SELECT  id
                FROM    seen_activities b
                WHERE   a.id = b.user_activities_id AND b.user_id = $inUser
                )");
        return response()->json(count($ini));
    }

    public function listnotification() {
        $activity = DB::connection('masterdata')->select('SELECT a.created_at, a.menu, a.aktivitas, a.keterangan, b.email, b.username, b.image, a.id FROM user_activities a JOIN users b ON a.id_user = b.id ORDER BY a.id DESC LIMIT 30');
        return view('admin.configuration.listnotification', ['activity' => $activity]);
    }

    public function read(Request $request){
        SeenActivities::create(['user_id' => auth()->user()->id,'user_activities_id'=>$request->id]);

        return response()->json(['success' => 'Readed']);
    }

    public function readallnotif() {
        $inUser = auth()->user()->id;
        $notif = DB::connection('masterdata')->select("SELECT  a.id
        FROM    user_activities a
        WHERE   NOT EXISTS
                (
                SELECT  id
                FROM    seen_activities b
                WHERE   a.id = b.user_activities_id AND b.user_id = $inUser
                )");
        foreach ($notif as $ntf) {
            SeenActivities::create(['user_id' => $inUser,'user_activities_id'=>$ntf->id]);
        }

        return response()->json(['success' => 'Readed']);
    }

    public function listuseronline() {
        $uonline = DB::connection('masterdata')->select('select * from users where status_access = 1 and id <> ' . auth()->user()->id);
        return view('admin.configuration.listuseronline', ['uonline' => $uonline]);
    }

    // public function openchat(Request $request) {
    //     $user = User::where(['id' => $request->id])->first();
    //     return view('admin.configuration.chatroom', ['user' => $user]);
    // }


}
