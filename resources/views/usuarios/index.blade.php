@extends('layouts.app')

@section('content')
<body style="background: #2c344c">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('usuarios.create') }}" class="btn btn-md btn-success mb-3">Nuevo usuarios</a>
                        <div>
                
                <a href="{{ route('generate-pdf') }}" class="btn btn-outline-danger btn-sm text-uppercase">PDF</a>
                
            </div>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                              <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Email</th>
                                <th scope="col">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($users as $user)
                                <tr>
                                <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->dir }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Está seguro ?');" action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
                                            <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>  
                          {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
@endsection