@extends('dashboard.layouts.main')

@section('main-body')

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong><br>
    <ul>
        @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



<div class="page-header">
    <h3 class="page-title"> Kategori </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategori</li>
        </ol>
    </nav>
</div>

{{-- Table --}}
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">Data Kategori</h4>
                    </div>
                    <div class="col text-end">
                        <a href="#" class="btn btn-success mb-2" data-toggle="modal" data-target="#modalTambah">Tambah</a>
                        
                    </div>
                </div>
        
                {{-- Modal Tambah Mulai --}}
                <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalLabelTambah" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabelTambah">Tambah Data</h5>
                                <a href="#" class="text-light text-decoration-none" data-dismiss="modal" aria-hidden="true">&times;</a>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kategori.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="namaKategori">Nama Kategori<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-light" name="nama" id="namaKategori" value="{{ old('nama') }}" placeholder="Nama" required>
                                        
                                        @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">
                                            Create
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Tambah Selesai --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            {{-- <tr class="bg-primary text-light"> --}}
                            <tr>
                                <th class="text-center fw-bold" width="20px">No</th>
                                <th class="fw-bold">Nama</th>
                                <th class="text-center fw-bold" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($dataKategori as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-circle btn-sm mx-1" data-toggle="modal" data-target="#modalEdit{{ $item->id }}">Edit</a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm mx-1" data-toggle="modal" data-target="#modalDelete{{ $item->id }}">Delete</a>
                                </td>
                            </tr>
        
                            {{-- Modal Edit Mulai --}}
                            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelEdit" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabelEdit">Edit Data</h5>
                                            <a href="#" class="text-light text-decoration-none" data-dismiss="modal" aria-hidden="true">&times;</a>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kategori.update', $item->id) }}" method="POST" autocomplete="off">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="namaKategori">Nama Kategori<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control text-light" name="nama" id="namaKategori" value="{{ $item->nama }}" placeholder="Nama" required>
                                                </div>
                    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal Edit Selesai --}}
        
                            {{-- Modal Delete Mulai --}}
                            <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalLabelDelete" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabelDelete">Pemberitahuan !</h5>
                                            <a href="#" class="text-light text-decoration-none" data-dismiss="modal" aria-hidden="true">&times;</a>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" autocomplete="off">
                                                @method('delete')
                                                @csrf
        
                                                <p>Apakah anda yakin ingin menghapus data </p>
                                                <p><b>{{ $item->nama }}</b></p>
                                                @if ($item->foto)
                                                <p class="text-center">
                                                    <img src="{{ asset('img/gudang/' . $item->foto) }}" alt="foto" class="img-fluid rounded" width="150px">
                                                </p>
                                                @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">
                                                Delete
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- Modal Delete Selesai --}}
        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Table --}}

@endsection


