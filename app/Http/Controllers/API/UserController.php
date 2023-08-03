<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as ResourcesUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index' , 'show']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $limit = $request->input('limit') <= 50 ?$request->input('limit'):15;
        return ResourcesUser::collection(User::paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class );
        return new ResourcesUser(User::create(
            [
                'name'=>$request->name , 
                'email'=>$request->email, 
                'password' => Hash::make($request->password),
            ]
        ));

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $user = new ResourcesUser($user);
        return $user->response()->setStatusCode(200 , 'Got Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update' ,$user);
        $user->update($request->all());
        return  new ResourcesUser($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $this->authorize('delete' ,$user);

        $user->delete();
        return 204;
    }
}
