<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        //'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        $this->validate($request, [
            'name'=> 'required',
            'dir'=> 'required',
            'email'=> 'required',
            'password'=> 'required'
        ]);
        
        //create user
        User::create([
            'name'      => $request->name,
            'dir'       => $request->dir,
            'email'     => $request->email,
            'password'  => $request->password
        ]);

        //redirect to index
        return redirect()->route('usuarios.index')->with(['success' => 'Usuario agregado con exito']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('usuarios.edit', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return view('usuarios.edit', compact('user'));
        $user = User::find($id);
        //return response()->json($user);
        return view('usuarios.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        /*$user->update([
            'id'        => $request->id,
            'name'      => $request->name,
            'dir'       => $request->dir,
            'email'     => $request->email,
            'password'  => $request->password
        ]);
        */
        User::updateOrCreate(['id' => $id],
                             ['name'     => $request->name,
                              'dir'      => $request->dir,
                              'email'    => $request->email,
                              'password' => $request->password]);

        //redirect to index
        return redirect()->route('usuarios.index')->with(['success' => 'Usuario modificado con exito!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index')->with(['success' => 'Usuario eliminado con exito!']);
    }
    public function generatePDF()
    {
        $data = [
            'title' => 'PDF Usuarios',
            'heading' => 'Datos Personales',
            'users' => User::all()
        ];
        $pdf = PDF::loadView('generate-pdf', $data);
        return $pdf->download('pdf.pdf');
    }
    public function export(){
        return Excel::download(new UsersExport, 'users.xlsx');
        }
}
