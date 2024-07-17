<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\AuthInterface;
use App\Http\Requests\RegisterRequest;
use App\Http\Traits\Apidesigntrait;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthRepository implements AuthInterface
{
    use Apidesigntrait;

    public function register($request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate -> fails()) {
            return $this->apiresponse(400 , 'faild' , $validate->errors());
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // return $this->apiresponse(200 , 'done');
        return $this->login($request);
    }

    public function login($request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate -> fails()) {
            return $this->apiresponse(400 , 'faild' , $validate->errors());
        }

        $credentials = $request->only('email' , 'password');
        if ($token = Auth::attempt($credentials)) {

            return $this->respondWithToken($token);
        }
        return $this->apiresponse(400 , 'not found');
    }

    protected function respondWithToken($token)
    {
        $array =[
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return $this->apiresponse(200 , 'done' , null ,$array);
    }

}

?>
