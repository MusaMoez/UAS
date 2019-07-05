@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Manajemen Data Pegawai</h3>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('/pegawai/new') }}" class="btn btn-primary btn-sm float-right">Tambah Data</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                <table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Kode Pegawai</th>           
            <th>Nama Pegawai</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Email</th>
            <th colspan="2">Aksi</th> <!-- MODIFIKASI INI DENGAN MENAMBAHKAN COLSPAN -->
        </tr>
    </thead>
    <tbody>
        @forelse($pegawais as $pegawai)
        <tr>
            <td>{{ $pegawai->kode_pegawai }}</td>
            <td>{{ $pegawai->nama_pegawai }}</td>
            <td>{{ $pegawai->phone }}</td>
            <td>{{ str_limit($pegawai->address, 50) }}</td>
            <td><a href="mailto:{{ $pegawai->email }}">{{ $pegawai->email }}</a></td>
            <td>
                <form action="{{ url('/pegawai/' . $pegawai->id) }}" method="POST">
                {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" class="form-control">
                    <a href="{{ url('/pegawai/' . $pegawai->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
            
            <!-- [... TAMBAHKAN FORM INI ...] -->
            <!-- KARENA YANG DIBUTUHKAN METHOD POST MAKA KITA MEMASUKKANNYA KEDALAM FORM -->
            <td>
                <form action="{{ route('invoice.store') }}" method="post">
                {{ csrf_field() }}
                    <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}" class="form-control">
                    <button class="btn btn-primary btn-sm">Buat Invoice</button>
                </form>
            </td>
            <!-- [... TAMBAHKAN FORM INI ...] -->
        </tr>
        @empty
        <tr>
            <td class="text-center" colspan="5">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
                        <div class="float-right">
                            {{ $pegawais->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection