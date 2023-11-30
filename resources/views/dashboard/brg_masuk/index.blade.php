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
    <h3 class="page-title"> Barang Masuk</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Barang Masuk</li>
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
                        <h4 class="card-title">Data Barang Masuk</h4>
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
                                <form action="{{ route('brg-masuk.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="barang">Barang<span class="text-danger">*</span></label>
                                        <select class="form-control text-light" name="barang_id" id="barang" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($dataBarang as $itemBarang)
                                            <option value="{{ $itemBarang->id }}">
                                                {{ $itemBarang->nama . ' (' .$itemBarang->kategori->nama . ')' }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl">Tanggal<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control text-light" name="tanggal" id="tgl" value="{{ old('tanggal') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                                        <input type="number" min="1" class="form-control text-light" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" placeholder="Harga" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ket">Keterangan</label>
                                        <textarea name="ket" class="form-control text-light" id="ket" cols="30" rows="10" placeholder="ket">{{ old('ket') }}</textarea>
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
                            <tr>
                                <th class="text-center fw-bold" width="20px">No</th>
                                <th class="fw-bold">Tanggal</th>
                                <th class="fw-bold">Nama Barang</th>
                                {{-- <th class="fw-bold">Kategori</th> --}}
                                <th class="fw-bold">Harga</th>
                                <th class="fw-bold">Jumlah</th>
                                <th class="fw-bold">Total Harga</th>
                                {{-- <th class="fw-bold">Keterangan</th> --}}
                                <th class="text-center fw-bold" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($dataBrgMasuk as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->barang->nama }}</td>
                                {{-- <td>{{ $item->barang->kategori->nama }}</td> --}}
                                <td>@money($item->barang->harga_satuan)</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>@money($item->total_harga)</td>
                                {{-- <td>{{ $item->ket }}</td> --}}
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
                                            <form action="{{ route('brg-masuk.update', $item->id) }}" method="POST" autocomplete="off">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="barang">Barang<span class="text-danger">*</span></label>
                                                    <select class="form-control text-light" name="barang_id" id="barang" required>
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($dataBarang as $itemBarang)
                                                        <option value="{{ $itemBarang->id }}" {{($item->barang_id == $itemBarang->id)? 'selected' : ''}}>
                                                            {{ $itemBarang->nama . ' (' .$itemBarang->kategori->nama . ')' }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tgl">Tanggal<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control text-light" name="tanggal" id="tgl" value="{{ $item->tanggal }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                                                    <input type="number" min="1" class="form-control text-light" name="jumlah" id="jumlah" value="{{ $item->jumlah }}" placeholder="Harga" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ket">Keterangan</label>
                                                    <textarea name="ket" class="form-control text-light" id="ket" cols="30" rows="10" placeholder="ket">{{ $item->ket }}</textarea>
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
                                            <form action="{{ route('brg-masuk.destroy', $item->id) }}" method="POST" autocomplete="off">
                                                @method('delete')
                                                @csrf
        
                                                <p>Apakah anda yakin ingin menghapus data </p>
                                                <p><b>{{ $item->tanggal.' - '.$item->barang->nama }}</b></p>
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


