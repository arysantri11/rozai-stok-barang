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
                        <h4 class="card-title">Data Barang</h4>
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
                                <form action="{{ route('barang.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="kategori">Kategori<span class="text-danger">*</span></label>
                                        <select class="form-control text-light" name="kategori_id" id="kategori" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach ($dataKategori as $itemKategori)
                                            <option value="{{ $itemKategori->id }}">{{ $itemKategori->nama }}</option>
                                            @endforeach
                                        </select>
                                        
                                        @error('kategori_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kodeBarang">Kode Barang<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-light" name="kode" id="kodeBarang" value="{{ old('kode') }}" placeholder="Kode" required>
                                        
                                        @error('kode')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="namaBarang">Nama Barang<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control text-light" name="nama" id="namaBarang" value="{{ old('nama') }}" placeholder="Nama" required>
                                        
                                        @error('nama')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="merk">Merk</label>
                                        <input type="text" class="form-control text-light" name="merk" id="merk" value="{{ old('merk') }}" placeholder="Merk">
                                    </div>
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran</label>
                                        <input type="text" class="form-control text-light" name="ukuran" id="ukuran" value="{{ old('ukuran') }}" placeholder="Ukuran">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga_satuan">Harga<span class="text-danger">*</span></label>
                                        <input type="number" min="0" class="form-control text-light" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan') }}" placeholder="Harga" required>
                                        
                                        @error('harga_satuan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="satuan">Satuan<span class="text-danger">*</span></label>
                                        <select class="form-control text-light" name="satuan" id="satuan" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="RIM">RIM</option>
                                            <option value="Lusin">Lusin</option>
                                            <option value="Buah">Buah</option>
                                            <option value="Unit">Unit</option>
                                        </select>
                                        
                                        @error('satuan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi</label>
                                        <textarea name="lokasi" class="form-control text-light" id="lokasi" cols="30" rows="10" placeholder="Lokasi">{{ old('lokasi') }}</textarea>
                                        
                                        @error('lokasi')
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
                            <tr>
                                <th class="text-center fw-bold" width="20px">No</th>
                                <th class="fw-bold">Kode</th>
                                <th class="fw-bold">Nama</th>
                                <th class="fw-bold">Kategori</th>
                                <th class="fw-bold">Merk</th>
                                <th class="fw-bold">Ukuran</th>
                                <th class="fw-bold">Harga</th>
                                <th class="fw-bold">Satuan</th>
                                <th class="fw-bold">Lokasi</th>
                                <th class="text-center fw-bold" width="80px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            @foreach ($dataBarang as $item)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->ukuran }}</td>
                                <td>@money($item->harga_satuan)</td>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->lokasi }}</td>
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
                                            <form action="{{ route('barang.update', $item->id) }}" method="POST" autocomplete="off">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="kategori">Kategori<span class="text-danger">*</span></label>
                                                    <select class="form-control text-light" name="kategori_id" id="kategori" required>
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($dataKategori as $itemKategori)
                                                        <option value="{{ $itemKategori->id }}" {{($item->kategori_id == $itemKategori->id)? 'selected' : ''}}>{{ $itemKategori->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                    @error('kategori_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="kodeBarang">Kode Barang</label>
                                                    <p>{{ $item->kode }}</p>
                                                    <input type="hidden" name="kode" value="{{ $item->kode }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="namaBarang">Nama Barang<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control text-light" name="nama" id="namaBarang" value="{{ $item->nama }}" placeholder="Nama" required>
                                                    
                                                    @error('nama')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="merk">Merk</label>
                                                    <input type="text" class="form-control text-light" name="merk" id="merk" value="{{ $item->merk }}" placeholder="Merk">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ukuran">Ukuran</label>
                                                    <input type="text" class="form-control text-light" name="ukuran" id="ukuran" value="{{ $item->ukuran }}" placeholder="Ukuran">
                                                </div>
                                                <div class="form-group">
                                                    <label for="harga_satuan">Harga<span class="text-danger">*</span></label>
                                                    <input type="number" min="0" class="form-control text-light" name="harga_satuan" id="harga_satuan" value="{{ $item->harga_satuan }}" placeholder="Harga" required>
                                                    
                                                    @error('harga_satuan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="satuan">Satuan<span class="text-danger">*</span></label>
                                                    <select class="form-control text-light" name="satuan" id="satuan" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="RIM" {{ ($item->satuan == "RIM")? 'selected' : '' }}>RIM</option>
                                                        <option value="Lusin" {{ ($item->satuan == "Lusin")? 'selected' : '' }}>Lusin</option>
                                                        <option value="Buah" {{ ($item->satuan == "Buah")? 'selected' : '' }}>Buah</option>
                                                        <option value="Unit" {{ ($item->satuan == "Unit")? 'selected' : '' }}>Unit</option>
                                                    </select>
                                                    
                                                    @error('satuan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="lokasi">Lokasi</label>
                                                    <textarea name="lokasi" class="form-control text-light" id="lokasi" cols="30" rows="10" placeholder="Lokasi">{{ $item->lokasi }}</textarea>
                                                    
                                                    @error('lokasi')
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
                                            <form action="{{ route('barang.destroy', $item->id) }}" method="POST" autocomplete="off">
                                                @method('delete')
                                                @csrf
        
                                                <p>Apakah anda yakin ingin menghapus data </p>
                                                <p><b>{{ $item->nama }}</b></p>
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


