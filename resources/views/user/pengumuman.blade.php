@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="display table" id="ul-contact-list" style="width:100%">
                    <thead>
                        <tr>
                            <th width="65%">Pengumuman</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumuman as $p)
                        <tr>
                            <td>
                                <a href="/user/pengumuman/{{ $p->slug }}">
                                    <strong>{{ $p->title }}</strong>
                                    <p>{{ str_limit($p->pengumuman), '100' }}</p>

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
                            <td>{{ $p->created_at }}</td>
                        </tr>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- end of main-content -->
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('theme/css/plugins/datatables.min.css')}}" />
@endsection
@section('js')
<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
<script src="{{asset('theme/js/scripts/contact-list-table.min.js')}}"></script>
<script src="{{asset('theme/js/scripts/datatables.script.min.js')}}"></script>
<script src="{{asset('theme/js/plugins/datatables.min.js')}}"></script>
<script src="{{asset('theme/js/scripts/tooltip.script.min.js')}}"></script>
<script>
    $('#ul-contact-list').DataTable({
        responsive: true,
        order: [
            [2, 'DESC']
        ]
    });
</script>
@endsection