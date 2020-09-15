<?php

namespace App\Http\Controllers;

use App\SeriesISaw\Services\Contracts\UserServiceInterface;
use App\SeriesISaw\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    protected $userService;

    public function __construct(UserServiceInterface $userService) {
        $this->userService = $userService;
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
