<!-- Modal -->
<div class="modal fade" id="userBlock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Block User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="blockUserForm" action="{{ route('admin_block_user') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="0" id="blockUserId">
                <input type="hidden" name="name" value="" id="blockUserName">
                <input type="hidden" name="email" value="" id="blockUserEmail">
                <div class="form-floating mb-3">
                    <input type="text" name="block_message" class="form-control" id="blockUserMessage">
                    <label for="">Reason for blocking</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Block</button>
            </div>
        </form>
    </div>
    </div>
</div>

<script>
    var blockButtons = document.getElementsByClassName('button-block');
    var blockUserId = document.getElementById('blockUserId');
    var blockUserName = document.getElementById('blockUserName');
    var blockUserEmail = document.getElementById('blockUserEmail');

    for( let i = 0; i < blockButtons.length; i++ ) {
        blockButtons[i].addEventListener('click', function() {
            blockUserId.value = this.dataset.id;
            blockUserName.value = this.dataset.name;
            blockUserEmail.value = this.dataset.email;
        });
    }
</script>