@extends('workspace.index')

@section('workspace.breadcrumbs')
{{-- {{ Breadcrumbs::render('editor-setting') }} --}}
@endsection

@section('workspace.layout')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <fieldset class="setting-fieldset">
                <button class="btn btn-primary create-board"><i
                        class="fas fa-plus"></i>&nbsp;{{ __('Create new board') }}</button>
                <hr>
                <div class="row">

                    @if(!blank($boards))
                    @foreach($boards as $board)
                    <div class="col-md-4">
                        <a href="">
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="{{ asset('images/trello.jpg') }}" alt="Card image">
                                <div class="card-img-overlay">
                                    <h5 class="card-text">{{ Str::limit($board->name, 30) }}</h5>
                                    <p class="card-text">{{ Str::limit($board->desc ,20)}}</p>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex justify-content-center my-1">
                            <button class="badge badge-primary mr-1 edit-board" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Edit" value="{{ $board->id }}">{{ __('Update') }}</button>
                            <button class="badge badge-danger" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="Delete" value="{{ $board->id }}">{{ __('Delete') }}</button>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                    @endif
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Board') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('board.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Board Title') }}</label><span class="text-danger">*</span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <input type="text" class="form-control" name="desc" value="{{ old('desc') }} ">
                    </div>
                    <input type="hidden" name="idOrganization"
                        value="{{ isset($idOrganization) ? $idOrganization : '' }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="boardEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Board') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('board.update') }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Board Title') }}</label><span class="text-danger">*</span>
                        <input type="text" name="name" id="board_name" class="form-control" value=""
                            required>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <input type="text" class="form-control" id="desc" name="desc" value="">
                    </div>
                    <input type="hidden" name="board_id" id="board_id" value="">
                    <input type="hidden" name="idOrganization" id="idOrganization" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".create-board").click(function () {
            $("#exampleModal").modal('show');
        });

        $(".delete-board").click(function () {
            if(confirm('Are Your sure?')){
                var board_id = $(this).val();
                var idOrganization = "{{ isset($idOrganization) ? $idOrganization : '' }}";
                $.ajax({
                type: "post",
                url: "{{ route('board.delete') }}",
                data: {
                         board_id : board_id,
                         idOrganization : idOrganization,
                    },
                cache: false,
                success: function (data) {
                    if (data == 'Success') {
                        toastr["success"]("Success")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "500",
                            "hideDuration": "500",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    } else {
                        toastr["error"]("Error")
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "500",
                            "hideDuration": "500",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                    }
                    location.reload();
                }
            });
            }
        });

        $(document).on('click', '.edit-board', function () {
            var board_id = $(this).val();
            $.ajax({
                type: "post",
                url: "{{ route('board.edit') }}",
                data: {board_id : board_id},
                cache: false,
                success: function (data) {
                    $('#board_name').val(data.name);
                    $('#desc').val(data.desc);
                    $('#board_id').val(data.id);
                    $('#idOrganization').val(data.idOrganization);
                    $('#boardEditModal').modal('show');
                }
            });
        });
    });

</script>
@endsection
