<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TodoControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // $todos = Todo::with('user')->get();

        $user_id = auth()->user()->id;
        $data['todos'] = Todo::where('user_id', '=', $user_id)->get();
        $data['i'] = 0;
        return view('todo.index', $data);
        // $todos = Todo::latest()->paginate(5);
        // return view ('todo.index',compact('todos'))->with('i', (request()->input('page', 1) -1) * 5);
    }

    public function create()
    {
        $data['user_id'] = auth()->user()->id;
        return view('todo.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'pembuat' => 'required',
            'tanggal' => 'required',
        ]);
        Todo::create($request->all());

        return redirect()->route('todo.index')->with('succes','Todo List Berhasil di Tambahkan');
    }
    
    public function show(Todo $todo)
    {
        return view('todo.show',compact('todo'));
    }

    public function edit(Todo $todo)
    {
        return view('todo.edit', compact('todo'));
    }
    
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi' => 'required',
            'pembuat' => 'required',
            'tanggal' => 'required',
        ]);

        $todo->update($request->all());
        return redirect()->route('todo.index')->with('succes','Todo List Berhasil di Update');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todo.index')->with('succes','Todo List Berhasil di Hapus');
    }
}
