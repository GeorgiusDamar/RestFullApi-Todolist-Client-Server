<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todolist;
use Illuminate\Http\Request;

class TodolistControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index1()
    // {
    //     //menampilkan request todolist
    //     $data = Todolist::get();
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data Todolist ditemukan!',
    //         'data' => $data
    //     ], 200);
    // }


    // Search todos
    public function index(Request $request)
    {
        $query = Todolist::query();

        if ($request->has('todo')) {
            $query->where('title', 'like', '%' . $request->todo . '%');
        }

        if ($request->has('is_completed')) {
            $query->where('is_completed', $request->is_completed);
        }

        $todos = $query->paginate($request->size ?? 10);

        return response()->json([
            'data' => $todos->items(),
            'errors' => null,
            'meta' => [
                'current_page' => $todos->currentPage(),
                'total' => $todos->total(),
            ]
        ], 200);
    }


    // Create new todo
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([

    //         'todo' => 'required|string',
    //         'is_completed' => 'boolean'
    //     ]);

    //     $todo = Todolist::create([


    //         'todo' => $validated['todo'],
    //         'is_completed' => $validated['is_completed'] ?? false,
    //     ]);
    //     if ($todo->todo == null) {
    //         return response()->json(['errors' => 'Todolist can not added'], 404);
    //     }
    //     dd($todo);

    //     return response()->json([
    //         'data' => $todo,
    //         'errors' => null
    //     ], 200);
    // }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'todo' => 'required|string',
    //         'is_completed' => 'boolean'
    //     ]);

    //     $todo = Todolist::create([
    //         'todo' => $validated['todo'],
    //         'is_completed' => $validated['is_completed'] ?? false,
    //     ]);

    //     return response()->json([
    //         'data' => $todo,
    //         'errors' => null
    //     ], 201); // Gunakan 201 Created untuk response sukses saat membuat resource baru
    // }

    // public function store(Request $request){
    //     $data = new Todolist;

    //     $data->todo = $request->todo;
    //     $data->is_completed = $request->is_completed;
    //     $data->studentId = $request->studentId;

    //     $post = $data->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data berhasil ditambahkan!'
    //     ]);


    // } mntb

    public function store(Request $request)
    {
        // Validasi input dari permintaan
        $validated = $request->validate([
            'todo' => 'required|string',
            'is_completed' => 'boolean', // Validasi boolean
        ]);

        // Buat instance baru dari Todolist
        $data = new Todolist;

        // Set nilai untuk kolom yang diperlukan
        $data->todo = $validated['todo'];
        // Ubah nilai is_completed menjadi integer

        if ($data->is_completed) {

            $data->is_completed = $validated['is_completed'] ? 1 : 0;
        } else {
            $data->is_completed = 0;
        }

        // Ambil studentId dari user yang saat ini login
        $user = $request->user();
        $data->studentId = $user->id;

        // Simpan data ke database
        $data->save();

        return response()->json([
            'status' => true,
            'message' => 'Data Todo berhasil ditambahkan :)',
            'data' => $data
        ], 201);
    }




    // Get todo by id
    public function show($id)
    {
        $todo = Todolist::find($id);

        if (!$todo) {
            return response()->json(['errors' => 'Todo tidak ditemukan!'], 404);
        }

        return response()->json([
            'data' => $todo,
            'massage' => 'Todo berhasil ditemukan!',
            'errors' => null
        ], 200);
    }

    // Update todo by id
    public function update(Request $request, $id)
    {
        $todo = Todolist::find($id);

        if (!$todo) {
            return response()->json(['errors' => 'Todo tidak ditemukan!'], 404);
        }

        $validated = $request->validate([
            'todo' => 'required|string',
            'is_completed' => 'boolean'
        ]);

        $todo->update([
            'title' => $validated['todo'],
            'is_completed' => $validated['is_completed'] ?? $todo->is_completed,
        ]);

        return response()->json([
            'data' => $todo,
            'massage' => 'Todo berhasil diperbaharui!',
            'errors' => null
        ], 200);
    }

    // Delete todo by id
    public function destroy($id)
    {
        $todo = Todolist::find($id);

        if (!$todo) {
            return response()->json(['errors' => 'Todo tidak ditemukan :('], 404);
        }

        $todo->delete();

        return response()->json([
            'data' => true,
            'massage' => 'Todo berhasil dihapus!',
            'errors' => null
        ], 200);
    }
}
