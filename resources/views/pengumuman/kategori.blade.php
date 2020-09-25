@extends('layouts.app')
@section('content')
@if(session('success'))
<div class="alert alert-success" role="alert">
    <strong>Berhasil!</strong> {{session('success')}}
</div>
@elseif(session('update'))
<div class="alert alert-warning" role="alert">
    <strong>Berhasil!</strong> {{session('update')}}
</div>
@elseif(session('delete'))
<div class="alert alert-danger" role="alert">
    <strong>Berhasil!</strong> {{session('delete')}}
</div>
@endif
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3>Pengumuman</h3>
            </div>
            <div class="card-body">
                <div class="ul-contact-list">
                    <div class="contact-close-mobile-icon float-right mb-2"><i class="i-Close-Window text-15 font-weight-600"></i></div>
                    <!-- modal-->
                    <a href="{{route('inkubator.tambah')}}"><button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal">Tambah Pengumuman</button></a>
                    <!-- end:modal-->
                    @foreach($kategori as $y)
                    <form action="/inkubator/kategori/{{ $y->id }}/search" method="GET">
                        <input value="{{ Request::get('keyword') }}" name="keyword" class="form-control form-control-rounded col-md-12" id="exampleFormControlInput1" type="text" placeholder="Search Tenant..." />
                    </form>
                    <br>
                    @endforeach
                    <div class="list-group" id="list-tab" role="tablist"><a class="list-group-item list-group-item-action border-0" id="list-home-list" href="/inkubator/pengumuman" role="tab" aria-controls="home"><i class="nav-icon i-Business-Mens"></i> Semua Pengumuman</a>
                        <a class="list-group-item list-group-item-action border-0" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile"><i class="nav-icon i-Conference"></i> Non Tenan</a>
                        <label class="text-muted font-weight-600 py-8" for="">MEMBERS INKUBATOR</label>
                        <select class="form-control form-control-rounded">
                            <option>All Inkubator</option>
                        </select>
                        </br>
                        <a class="list-group-item list-group-item-action border-0 {{ set_active('inkubator.kategori')}}" id="list-home-list" href="{{route('inkubator.kategori')}}" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i>All Kategori</a>
                        @foreach($kategori as $y)
                        @if( $y->id == 1)
                        <a class="list-group-item list-group-item-action border-0 {{ set_active('inkubator.kategori-id', $y->id == 1 )}}" id="list-home-list" href="{{ route('inkubator.kategori-id', $y->id )}}" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i>{{ $y->name }}</a>
                        @elseif( $y->id == 2)
                        <a class="list-group-item list-group-item-action border-0 {{ set_active('inkubator.kategori-id', $y->id == 2 )}}" id="list-home-list" href="{{ route('inkubator.kategori-id', $y->id )}}" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i>{{ $y->name }}</a>
                        @elseif( $y->id == 3)
                        <a class="list-group-item list-group-item-action border-0 {{ set_active('inkubator.kategori-id', $y->id == 3 )}}" id="list-home-list" href="{{ route('inkubator.kategori-id', $y->id )}}" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i>{{ $y->name }}</a>
                        @else($y->id == 4)
                        <a class="list-group-item list-group-item-action border-0 {{ set_active('inkubator.kategori-id', $y->id == 4 )}}" id="list-home-list" href="{{ route('inkubator.kategori-id', $y->id )}}" role="tab" aria-controls="home"><i class="nav-icon i-Arrow-Next"></i>{{ $y->name }}</a>
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <table class="display table" id="ul-contact-list" style="width:100%">
                    <thead>
                        <tr>
                            <th width="65%">Pengumuman</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Status</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @foreach($pengumuman as $p)
                        <tr>
                            <td>
                                <a href="/inkubator/pengumuman/{{ $p->slug }}">
                                    <strong>{{ $p->title }}</strong>
                                    <p>{!! str_limit($p->pengumuman) !!}</p>
                                </a>
                            </td>
                            <td>
                                @if($p->priority_id == 1)
                                <a class="badge badge-success m-2 p-2" href="#">{{ $p->priority->name }}</a>
                                @elseif($p->priority_id == 2)
                                <a class="badge badge-danger m-2 p-2" href="#">{{ $p->priority->name }}</a>
                                @elseif($p->priority_id == 3)
                                <a class="badge badge-primary m-2 p-2" href="#">{{ $p->priority->name }}</a>
                                @else
                                <a class="badge badge-warning m-2 p-2" href="#">{{ $p->priority->name }}</a>
                                @endif
                            </td>
                            <td>{{ date('d F Y', strtotime($p->created_at)) }}</td>
                            <td class="custom-align">
                                <div class="btn-group">
                                    @if($p->publish == 1)
                                    <button class="btn btn-success custom-btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Publish</button>
                                    @else
                                    <button class="btn btn-danger custom-btn btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Draf</button>
                                    @endif
                                    <div class="dropdown-menu ul-task-manager__dropdown-menu">
                                        @if($p->publish == 1)
                                        <a class="dropdown-item btn btn-danger" href="{{ url('inkubator/pengumuman/status/'.$p->id)}}">Draf</a>
                                        @else
                                        <a class="dropdown-item btn btn-success" href="{{ url('inkubator/pengumuman/status/'.$p->id)}}">Publish</a>
                                        @endif
                                    </div>
                            </td>
                            <td><a class="ul-link-action text-success" data-toggle="tooltip" href="/inkubator/pengumuman/edit/{{ $p->id }}" data-placement="top" title="Edit"><i class="i-Edit"></i>
                                    <a class="ul-link-action text-danger mr-1" href="/inkubator/pengumuman/hapus/{{ $p->id }}" data-toggle="tooltip" data-placement="top" title="Want To Delete !!!">
                                        <i class="i-Eraser-2"></i></a>
                            </td>
                        </tr>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- end of main-content -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New Tenant</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<input class="form-control" type="text" placeholder="Title...." name="title" />
					</div>
					<div class="form-group">
						<select class="form-control">
							<option value="">Pilih Kategori</option>
							<option value="1"></option>
							<option value="2"></option>
							<option value="3"></option>
						</select>
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" placeholder="Pengumuman ...." name="pengumuman"></textarea>
					</div>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="exampleInputFile" name="file">
						<label class="custom-file-label" for="exampleInputFile">Choose file</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" type="button">
					Save
					changes
				</button>
			</div>
		</div>
	</div>
</div> end of form-input -->
@endsection
@section('css')
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
<link href="{{asset('theme/css/main.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('theme/css/plugins/datatables.min.css')}}" />
@endsection
@section('js')
<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
<script src="{{asset('theme/js/scripts/contact-list-table.min.js')}}"></script>
<script src="{{asset('theme/js/scripts/datatables.script.min.js')}}"></script>
<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
<script src="{{asset('theme/js/scripts/tooltip.script.min.js')}}"></script>
<script src="{{asset('theme/js/extention/choices.js')}}"></script>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 1500);

    $('#ul-contact-list').DataTable({
        responsive: true,
        order: [
            [2, 'DESC']
        ]
    });

    $('body').on('keyup', '#search', function() {
        var searchQuest = $(this).val();

        $.ajax({
            method: 'POST',
            url: '{{ route("inkubator.pengumuman") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                searchQuest: searchQuest,
            },

            succcess: function(res) {
                console.log(res)
            }
        });
    });
</script>
@endsection