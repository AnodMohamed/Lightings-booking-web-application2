<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
use Illuminate\Console\Command;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        //
        return view('dashboard.users.index');

    }

    public function getUsersDatatable()
    {
        //  $data = User::select('*');
        //  $users = Datatables::of($data)
        //          ->addIndexColumn()
        //          ->make(true);
        
        if (auth()->user()->can('viewAny', $this->user)) {
        $data = User::select('*');
        }else{
            $data = User::where('id' , auth()->user()->id);
        }
        return   Datatables::of($data)
        ->make(true);
    }
    
}
