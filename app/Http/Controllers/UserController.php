<?php

namespace App\Http\Controllers;

use \Validator;
use App\SeriesISaw\Services\Contracts\UserServiceInterface;
use App\SeriesISaw\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    private $status_code = 200;
    protected $userService;

    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
    }

    public function userSignUp(Request $request) {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required"
        ]);

        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "validation_error", "errors" => $validator->errors()]);
        }

        $username =  $request->username;
        $username  = explode(" ", $username);

        $userDataArray = array(
            "username" => $request->username,
            "password" => md5($request->password)
        );

        $user_status =  User::where("username", $request->username)->first();

        if(!is_null($user_status)) {
           return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! username already registered"]);
        }

        $user = User::create($userDataArray);

        if(!is_null($user)) {
            return response()->json(["status" => $this->status_code, "success" => true, "message" => "Registration completed successfully", "data" => $user]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "failed to register"]);
        }
    }


    public function userLogin(Request $request) {

        $validator = Validator::make($request->all(),
            [
                "username" => "required",
                "password" => "required"
            ]
        );

        if($validator->fails()) {
            return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
        }

        $username_status = User::where("username", $request->username)->first();

        if(!is_null($username_status)) {
            $password_status  = User::where("username", $request->username)->where("password", md5($request->password))->first();

            if(!is_null($password_status)) {
                $user =  $this->userDetail($request->username);

                return response()->json(["status" => $this->status_code, "success" => true, "message" => "You have logged in successfully", "data" => $user]);
            }

            else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
            }
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. username doesn't exist."]);
        }
    }

    public function userDetail($username) {
        $user = array();
        if($username != "") {
            $user = User::where("username", $username)->first();
            return $user;
        }
    }

    public function list() {
        return view('user.list')->with([
            'userList' => $this->userService->getList()
        ]);
    }

    public function store(Request $request) {
        $result = $this->userService->save($request->only(['username', 'password']));

        if ($result === true) {
            return redirect()->route('login')
                ->with('success', 'Saved Successfully!');
        }

        return redirect()->route('registration')
            ->withInput()
            ->withErrors($result);
    }


    public function create() {
        return view('registration');
    }

    public function edit($id) {
        return view('user.edit')->with([
            'user' => $this->userService
                ->getUser($id)
        ]);
    }

    public function update(Request $request, $id) {

        $result = $this->userService
            ->update($request->except(['_token', '_method']), $id);

        if ($result === true) {
            return redirect()->route('user.edit', $id)
                ->with('success', 'Updated Successfully!');
        }

        return redirect()->route('user.edit', $id)
            ->withErrors($result)
            ->withInput();
    }

    public function delete(Request $request, $id) {
        $result = $this->userService->delete($id);
        $list = $this->userService->getList();

        if ($result === true) {
            return redirect()->route('user.list')->with([
                'userList' => $list,
                'success' => 'Deleted Successfully'
            ]);
        }

        return redirect()->route('user.list')
            ->withErrors($result)
            ->with('userList', $list)
            ->withInput();
    }
}
