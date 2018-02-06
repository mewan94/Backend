<?php

namespace App\Http\Controllers\Todo;

use Illuminate\Http\Request;
use App\Repositories\TodoRepository as Todo;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    private $todo;

    public function __construct(Todo $todo) {

        $this->todo = $todo;
    }

    public function index(){
        return \Response::json($this->todo->all($columns = array('id','userid','name','status')));
    }

    public function create(Request $request){
        $request->validate([
            'todoname' => 'required|max:100',
            'status' => 'boolean'
        ]);
        $data=array(
            /*'userid' => $request->user()->id,*/
            'userid' => 1,
            'name' => $request->todoname,
            'status' => $request->status
        );
        $this->todo->create($data);
        return \Response::json($this->todo->all($columns = array('id','userid','name','status')));
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'exists:todos,id',
            'todoname' => 'required|max:100',
            'status' => 'boolean'
        ]);
        $data=array(
            'userid' => 1,
            'name' => $request->todoname,
            'status' => $request->status
        );
        $this->todo->update($data,$request->id);
        return \Response::json($this->todo->find($request->id, $columns = array('*')));
    }

    public function check(Request $request){
        $request->validate([
            'id' => 'exists:todos,id'
        ]);
        $data=array(
            'status' => 1
        );
        $this->todo->update($data,$request->id);
        return \Response::json($this->todo->find($request->id, $columns = array('*')));

    }

    public function uncheck(Request $request){
        $request->validate([
            'id' => 'exists:todos,id'
        ]);
        $data=array(
            'status' => 0
        );
        $this->todo->update($data,$request->id);
        return \Response::json($this->todo->find($request->id, $columns = array('*')));
    }

    public function delete(Request $request){
        $request->validate([
            'id' => 'exists:todos,id'
        ]);
        $this->todo->delete($request->id);
        return \Response::json($this->todo->all($columns = array('id','userid','name','status')));
    }
}
