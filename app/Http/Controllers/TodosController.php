<?php

namespace App\Http\Controllers;

use App\Models\todos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TodosController extends Controller
{
    public function login()
    {
        //menampilkan halaman awal, semua data
        // ambil semua data todo dari database

        $todos = todos::all();
        //tampilin file home di folder dashboard dan bawa data dari variable yang namanya todos ke file tersebut
        return view('dashboard.login', compact('todos'));
    }

    public function register()
    {
        return view('dashboard.register');
    }
    
    public function inputRegister(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' =>'required|min:4|max:50',
            'username' => 'required|min:4|max:50',
            'email' => 'required',
            'password' => 'required',

        ]);
        //tambah data ke db bagian table user
        User::create([
            'name' =>$request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        //apabila berhasil, bakal diarahin ke halaman login dengan pesan success
        return redirect('/')->with('success', 'berhasil membuat akun!');
    }    
    
    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ],[
            'username.exists'=>"This user doesn't exists"
        ]);

        $user = $request->only('username', 'password');
        if (Auth::attempt($user)){
            return redirect()->route('todo.index');
        }else{
            return redirect('/')->with('fail', "Gagal login, periksa dan coba lagi!");
        }
    }

    public function logout()
    {
        //meghapus history login
        Auth::logout();
        //mengarahkan ke halaman login lagi
        return redirect('/');
    }
    public function index()
    {
        //mrnampilkan halaman awal, semua data
        //cari data todo yang punya user_id nya sama dengan id prang yang login. kalau krtemu datanya diambil
        $todos = todos::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 0],
        ])->get();
        //tampilin file index di folder dashboard dan bawa data dari variable yang namanya todos ke file tersebut
        return view('dashboard.home', compact('todos'));
    }

    public function complated()
    {
        $todos = todos::where([
            ['user_id', '=', Auth::user()->id],
            ['status', '=', 1],
        ])->get();
        return view('dashboard.complated',  compact('todos'));
    }

    public function updateComplated($id)
    {
        //$id pada parameter mengambil data dari path dinamis {id} 
        //cari data yang memiliki value column id sama dengan data id yang dikirim ke route, maka update baris data tersebut
        todos::where('id', $id)->update([
            'status' => 1,
            'done_time' => Carbon::now(),
        ]);
        //kalau berhasil bakal diarahin ke halaman list todo yg complated dengan pemberitahuan
        return redirect()->route('todo.complated')->with('done', 'Todo sudah selesai di kerjakan');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required:min:8',
        
        ]);
        //tambah data ke db
        todos::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('todo.index')->with('successAdd', 'Berhasil menambahkan data ToDo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function show(todos $todos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //menampilkan form edit data
        $todo = todos::where('id', $id)->first();
        //lalu tampilkan halaman 
        return view('dashboard.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required',
            'description' => 'required:min:8',
            
        ]);

        todos::where('id', $id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 0,
            'user_id' => Auth::user()->id,   
        ]);  

        return redirect('/todo/')->with('successUpdate', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //parameter $id  mengambil data dari path dinamis {id}
        //cari data yang isian column id nya sama dengan $id yang dikirim ke path dinamis
        //kalau ada, ambil terus hapus datanya
        todos::where('id', '=', $id)->delete();
        //kalau berhasil, nakal dibalikin ke halaman list todo dengan pemberitahuan
        return redirect()->route('todo.index')->with('successDelete', 'Berhasil menghapus data todo!');
    }
}
