@extends('template')

@section('content')
    <div class="row mt-5 mb-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h2>TODO LIST</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="{{ route('todo.create') }}"> Tambah Todo</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('succes'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th width="20px" class="text-center">No</th>
            <th width="280px"class="text-center">Nama Kegitan</th>
            <th width="280px"class="text-center">Deskripsi</th>
            <th width="280px"class="text-center">Pembuat</th>
            <th width="280px"class="text-center">Tanggal Dibuat</th>
            <th width="280px"class="text-center">Action</th>
        </tr>
        @foreach ($todos as $todo)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $todo->nama_kegiatan }}</td>
            <td>{{ $todo->deskripsi }}</td>
            <td>{{ $todo->pembuat }}</td>
            <td>{{ $todo->tanggal }}</td>
            <td class="text-center">
                <form action="{{ route('todo.destroy',$todo->id) }}" method="POST">

                   <a class="btn btn-info btn-sm" href="{{ route('todo.show',$todo->id) }}">Show</a>

                    <a class="btn btn-primary btn-sm" href="{{ route('todo.edit',$todo->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


@endsection