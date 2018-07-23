<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facedes\Auth;
use Validator;
class PassportController extends Controller
{
    public $success="200";
   
    public function index()
    {
       if(Auth::attempt(['email']=>request('email'),'password'=>request('password')))
       {
           $user=Auth::user();
           $successData['token']=$user->createToken('Myapp')->accessToken;
           return responce()->json(['success'=>$success],$this->successStatus);
       }
       else{
           return response()->json('error'=>'Unauthorized',401);
       }
    }

   
    public function create()
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password'
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->error()],401);
        }
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $user=User::create($input);
        $successData['token']=$user->createToken('Myapp')->accessToken;
        return responce()->json(['success'=>$success],$this->successStatus);
    }

    
    public function store(Request $request)
    {
        //
    
    }
    public function getDetails()
    {
        $user=Auth::user();
        return responce()->json(['success'=>$success],$this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
