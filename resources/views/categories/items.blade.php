@extends('vendor.admin.site-bases.inc.layout')

@section('title', 'კატეგორიები')

@section('content')
    @include('vendor.admin.site-bases.inc.message')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>კატეგორიები</h2>
                    <a href="{{ url('admin/categories/create') }}" class="btn btn-sm btn-success pull-right">
                        <i class="fa fa-plus"></i> დამატება
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(count($categries))
                        <ul class="list-group">
                        @foreach ($categries as $key => $item)
                            <li class="list-group-item sort cursor-move" data-id="{{ $item->id }}" data-ordering="{{ $item->ordering }}">
                                <span class="pull-left">
                                    <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                    @if ($item->image)
                                        <img src="{{ asset($item->image) }}" alt="">
                                    @endif
                                    {{ $item->id }} : {{ $item->title }}
                                </span>

                                <span class="pull-left">
                                    <input type="checkbox" id="{{ $item->id }}" class="js-switch publish" {{ $item->published ? 'checked' : '' }}/>
                                </span>
                                <span class="pull-right">
                                    <a href="{{ url('/categories/edit/' . $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ url('/categories/delete/' . $item->id) }}" class="delete btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                </span>
                                @include('vendor.admin.site-bases.categories.category-child' , ['category' => $item])
                            </li>
                        @endforeach
                        </ul>
                    @else
                        <div class="alert alert-info">
                            კატეგორიები ვერ მოიძებნა
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
	<script src="{{asset('assets/admin')}}/js/jquery.min.js"></script>
	<script src="{{asset('assets/admin')}}/js/jquery-ui.min.js"></script>
	<script src="{{asset('assets/admin')}}/js/bootstrap.min.js"></script>
	<script>
        $(document).ready(function() {
            $('.delete').click(function(e) {
                var target = $(this).attr('href');
                e.preventDefault();
                $.confirm({
                    title: 'დასტური',
                    content: 'დარწმუნებული ხართ, რომ გურთ ამის სამუდამოდ წაშლა?',
                    buttons: {
                        confirm: {
                            text: 'წაშლა',
                            btnClass: 'btn-red',
                            action: function(){
                                location.replace(target)
                            }
                        },
                        close: {
                            text: 'დახურვა',
                            action: function(){
                            }
                        }
                    }
                });
            });

            $('.publish').change(function(event) {
                var id = $(this).attr('id');
                var published = ($(this).is(':checked')) ? 1 : 0;
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    url: '{{ url("admin/categories/publish") }}',
                    type: "post",
                    data: {
                        id: id,
                        published: published,
                        _token: '{{ csrf_token() }}',
                        className: "{{ addslashes(config('kakhura.site-bases.publish_classes.categories')) }}"
                    },
                    success: function (response) {
                        if (response.status == 'success'){
                            new PNotify({
                                text: 'წარმატებით განახლდა',
                                type: 'success',
                                styling: 'bootstrap3'
                            });
                        } else {
                            new PNotify({
                                text: 'დაფიქსირდა შეცდომა',
                                type: 'error',
                                styling: 'bootstrap3'
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        new PNotify({
                            text: 'დაფიქსირდა შეცდომა',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                });
            });

            $('.list-group').sortable({
                update: function(event, ui){
                    var parent = $(ui.item).parent().parent().data('id') == undefined ? $(ui.item).index() : $(ui.item).parent().parent().data('id');
                    var children = $(ui.item).parent().find('> li');
                    var arr = [];
                    children.each(function(){
                        $(this).attr('data-ordering',$(this).index());
                        arr.push( [$(this).attr('data-id') , (parent + ($(this).attr('data-ordering')))]);
                    });
                    arr = JSON.stringify(arr);
                    $.ajax({
                        url:"{{ url('admin/categories/ordering') }}",
                        type:"POST",
                        data:"_token={{ csrf_token( )}}" + "&ordering=" + arr,
                    })
                    .done(function(data){
                        new PNotify({
                            text: 'წარმატებით განახლდა',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    })
                }
            });
        });
	</script>
@endsection

@section('js')

    <script type="text/javascript">
    </script>
@endsection

@section('css')
    <style type="text/css">
        .post {
            width: 30px;
            height: 30px;
            vertical-align: middle;
            margin-right: 10px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
            vertical-align: middle;
        }
        .table>thead .iCheck-helper{
            background: #101010 !important;
        }
        .cursor-move {
            cursor: move;
        }
    </style>
@endsection
