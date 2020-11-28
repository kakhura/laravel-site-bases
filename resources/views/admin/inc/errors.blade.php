@if (count($errors) > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach ($errors->getMessages() as $key => $messages)
                        @foreach ($messages as $text)
                            <li>{{ $key }} - {{ $text }}</li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
