<?php

namespace App\Http\Controllers;

    use App\Task;
    use Illuminate\Http\Request;

    class TaskController extends Controller
    {

        /*
        public function index(){
            return view('layouts.crudapp');
        }
        */

        public function index(){
           //  $tasks = Task::paginate(4);
            // return view('tasks');
            // $tasks = Task::all();
            $tasks = Task::orderBy('order_of_tasks')->get();
            return view('tasks', compact('tasks'));
        }

        /*
        public function create(){
            return view('layouts.create');
        }
        */

        public function create(){
            return view('create');
        }

        public function store(Request $request){
            // return $request->all();
            $this->validate($request,[
                'name' => 'required',
            ]);

            $tasks = new Task();
            $tasks->name = $request->name;
            $tasks->details = $request->details;
            $tasks->order_of_tasks = $request->order_of_tasks;
            $tasks->completed = $request->completed;
            $tasks->save();

            return redirect(route('home'))->with('successMsg', 'New Task Added Successfully');
        }

        public function edit($id){
            $task = Task::find($id);
            return view('edit', compact('task'));
        }

        public function update(Request $request, $id){
            $this->validate($request,[
                'name' => 'required',
            ]);
            $task = Task::find($id);
            $task->name = $request->name;
            $task->details = $request->details;
            $task->order_of_tasks = $request->order_of_tasks;
            $task->completed = $request->completed;
            $task->save();
            return redirect(route('home'))->with('successMsg', ' Task Successfully Updated');
        }
        public function updateAll(Request $request){
            $tasks = Task::all();
            foreach ($tasks as $task) {
                $task->timestamps = false;
                $id = $task->id;
                foreach ($request->tasks as $taskFrontEnd) {
                    if ($taskFrontEnd['id'] == $id) {
                        $task->update(['order_of_tasks' => $taskFrontEnd['order_of_tasks']]);
                    }
                }
            }
            return response('Update Successful.', 200);
        }

        public function delete($id){
            Task::find($id)->delete();
            return redirect(route('home'))->with('successMsg', ' Task Deleted Successfully ');
        }

    }