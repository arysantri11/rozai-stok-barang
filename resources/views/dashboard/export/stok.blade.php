<!doctype html>
<html class="no-js" lang="en">

<html>
<head>
	<title>*Data Stok Barang</title>
	<link rel="icon" type="image/png" href="favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-144808195-1');
	</script>
</head>

<body>
	<div class="container">
		<h2>Stok Barang</h2>
		<h4>(Inventory)</h4>
		<div class="data-tables datatable-dark">
			<table id="dataTable3" class="display" style="width:100%">
				<thead class="thead-dark">
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Kategori</th>
						<th>Merk</th>
						<th>Ukuran</th>
						<th>Stok</th>
						<th>Satuan</th>
						<th>Harga</th>
						<th>Total Harga</th>
						<th>Lokasi</th>
						
						<!--<th>Opsi</th>-->
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
                    @foreach ($dataStok as $item)
					<tr>
						<td>{{ $no++ }}</td>
						<td>{{ $item->barang->nama }}</td>
						<td>{{ $item->barang->kategori->nama }}</td>
						<td>{{ $item->barang->merk }}</td>
						<td>{{ $item->barang->ukuran }}</td>
						<td>{{ $item->stok }}</td>
						<td>{{ $item->barang->satuan }}</td>
						<td>@money($item->barang->harga_satuan)</td>
						<td>@money($item->total_harga)</td>
						<td>{{ $item->barang->lokasi }}</td>
					</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
	
	<script>
		$(document).ready(function() {
			$('#dataTable3').DataTable( {
				dom: 'Bfrtip',
				buttons: ['copy', 'csv', 'excel', 'pdf', 'print',]
			} );
		});
	</script>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
</body>

</html>