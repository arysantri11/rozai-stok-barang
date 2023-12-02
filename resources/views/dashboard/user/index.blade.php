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
    <h3 class="page-title"> {{ $title }} </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
                        <h4 class="card-title">Data User</h4>
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
                                <form action="{{ route('user.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-light" name="username" id="username" value="{{ old('username') }}" placeholder="Username" required>
                                        
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">Nama Lengkap<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-light" name="name" id="namaLengkap" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                                        
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control text-light" name="password" id="password" placeholder="Password" required>
                                        
                                        @error('password')
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
                                <th class="fw-bold">Username</th>
                                <th class="fw-bold">Nama</th>
                                <th class="fw-bold">Role</th>
                                <th class="text-center fw-bold" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($dataUser as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ ($item->role === '1')? 'Operational Staff' : 'Branch Office Service Manager' }}</td>
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
                                            <form action="{{ route('user.update', $item->id) }}" method="POST" autocomplete="off">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="username">Username<span class="text-danger">*</span></label>
                                                    <p>{{ $item->username }}</p>
                                                    <input type="hidden" name="username" value="{{ $item->username }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="namaLengkap">Nama Lengkap<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control text-light" name="name" id="namaLengkap" value="{{ $item->name }}" placeholder="Nama Lengkap" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password (Isi jika ingin mengubah password)</label>
                                                    <input type="password" class="form-control text-light" name="password" id="password" placeholder="Password">
                                                    
                                                    @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role<span class="text-danger">*</span></label>
                                                    <select class="form-control text-light" name="role" id="role" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="1" {{ ($item->role == "1")? 'selected' : '' }}>Operational Staff</option>
                                                        <option value="2" {{ ($item->role == "2")? 'selected' : '' }}>Branch Office Service Manager</option>
                                                    </select>
                                                    
                                                    @error('role')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
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
                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST" autocomplete="off">
                                                @method('delete')
                                                @csrf
        
                                                <p>Apakah anda yakin ingin menghapus data </p>
                                                <p><b>{{ '('.$item->username.') '.$item->nama }}</b></p>
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


