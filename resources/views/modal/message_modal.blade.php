<!-- Modal -->
<div class="modal fade" id="errorMessages" tabindex="-1" role="dialog" aria-labelledby="errorMessagesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@if( $errors->any() ) Error @else Message @endif</h5>
        <button onclick="errorsModal.hide()" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            @if($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @elseif( session()->has('messageForModal') )
                <p>{!! session('messageForModal') !!}</p>
            @else
                <p>Your action is successful.</p>
            @endif
        </div>
        <div class="modal-footer">
        <button onclick="errorsModal.hide()" type="button" id="close-modal" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>

<script>
    var errorsModal = new bootstrap.Modal(document.getElementById('errorMessages'), {
        keyboard: false,
        backdrop: 'static'
    });
    errorsModal.show();
</script>