@extends('workspace.index')

@section('workspace.breadcrumbs')
{{ Breadcrumbs::render('list') }}
@endsection

@section('workspace.layout')
<div class="col-md-9">
    <div class="card">
        <div class="card-body">
            <fieldset class="setting-fieldset">
                <button class="btn btn-primary create-list"><i
                        class="fas fa-plus"></i>&nbsp;{{ __('Add another list') }}</button>
                <hr>
                @if(!blank($lists))
                <div class="row">
                    @foreach ($lists as $list)
                    <div class="col-md-6">
                        <div class="card p-2 list-style">
                            <div class="list-title" data-id="{{ $list->id }}">
                                <span class="list-title-text">{{ $list->name }}</span>
                                <span class="list-title-icon"><i class="fas fa-ellipsis-h"></i></span>
                            </div>
                            @if(isset($cardlist[$list->id]))
                                @foreach($cardlist[$list->id] as $card)
                                <li class="list-group-item d-flex justify-content-between align-items-center card-view" data-card="{{ $card['id'] }}">
                                  {{ $card['name'] }}
                                </li>
                                @endforeach
                            @endif   
                            <div class="p-card" style="padding: 10px 0px">
                                <a class="add-card" href="javascript:void(0)" data-id="{{ $list->id }}"><i
                                        class="fas fa-plus"></i>&nbsp; {{ __('add a card') }} </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </fieldset>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add another list') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('list.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('List') }}</label><span class="text-danger">*</span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>
                    <input type="hidden" name="idBoard" value="{{ $idBoard }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Card') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('list.card.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label><span class="text-danger">*</span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <input type="text" class="form-control" name="desc" value="{{ old('desc') }} ">
                    </div>
                    <input type="hidden" name="idList" id="idList" value="">
                    <input type="hidden" name="idBoard" value="{{ $idBoard }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="CardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Card Details') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body card-details">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 id="card-name" class="mb-1"></h5>
                      </div>
                      <p id="card-desc" class="mb-1"></p>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@include('workspace.workspace-modal')


@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".create-list").click(function () {
            $("#exampleModal").modal('show');
        });

        $(".add-card").click(function () {
            var idList = $(this).data('id');
            $('#idList').val(idList);
            $("#createCard").modal('show');
        });

        $(".btn-workspace").click(function () {
            $("#workspace").modal('show');
        });

        $(document).on('click', '.card-view', function () {
            var card_id = $(this).data('card');
            $.ajax({
                type: "post",
                url: "{{ route('list.card.show') }}",
                data: {
                    card_id: card_id
                },
                cache: false,
                dataType: "json",
                success: function (data) {
                    $('#card-name').text(data.name);
                    $('#card-desc').text(data.desc);
                    $('#CardModal').modal('show');
                }
            });
        });
    });

</script>
@endsection
