<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try{
            if(request()->ajax()){
                return DataTables::of(User::select('name', 'email', 'mobile_number', 'description', 'image', 'role_id')->get())
                    ->addColumn('role', function($user){
                        return $user->role->name ?? '';
                    })->addColumn('profile_image', function($user){
                        return "<img src='".url($user->image)."' height='50' width='50'>";
                    })->rawColumns(['role', 'profile_image'])->make(true);
            }else{
                $roles = Role::select('id', 'name')->get();
                return view('index', compact('roles'));
            }
        }catch(Exception $ex){
            Log::info($ex);
            return response()->json([
                'status'=>'error',
                'message'=>$ex->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'email'=>'required|email',
                'mobile_number'=>'required|numeric|digits:10',
                'description'=>'required',
                'role_id'=>'required',
                'image'=>'required|file|mimes:jpeg,png,gif|max:2048'
            ], [
                'role_id.required'=>'The role field is required.',
                'image.required'=>'The profile image field is required.',
                'image.file'=>'The selected file is invalid.',
                'image.mimes' => 'The profile image must be a JPEG, PNG, or GIF file.',
                'image.max' => 'The profile image must not be larger than 2 MB.'
            ]);
            if($validator->fails()){
                return response()->json([
                    'status'=>'error',
                    'message'=>'Validation error',
                    'errors'=>$validator->errors()
                ], 422);
            }
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile_number = $request->mobile_number;
            $user->description = $request->description;
            $user->role_id = $request->role_id;
            $user->image = $request->file('image')->store('images');
            $user->save();
            return response()->json([
                'status'=>'success',
                'message'=>'User created successfully.'
            ]);
        }catch(Exception $ex){
            Log::info($ex);
            return response()->json([
                'status'=>'error',
                'message'=>$ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
