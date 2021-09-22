<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TestController extends Controller
{
    public function index()
    {
        // Resource 디렉터리에서 views/tasks/index.blade.php 파일이나 views/tasks/index.php 파일을 찾는다.
        // 그 다음 Task::all() 메서드의 결과 값을 'tasks'라는 이름의 변수로 전달한다.
        // return view('tasks.index')->with('tasks', Task::all());
        //
        // return view('todo')->with(compact('todo'));
        // return view('todo')->with('todo', Todo::all());
        return view('tests.index')->with('tests', Test::all());
    }

    public function create()
    {
        return view('tests.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Test::create($data);
        return Redirect('test');
    }
}
