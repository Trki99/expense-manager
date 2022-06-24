<!-- Modal -->
<div class="modal fade" id="userUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateUserForm" action="{{ route('admin_update_user') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="0" id="updateUserId">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="updateUserName">
                    <label for="">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="updateUserEmail">
                    <label for="">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="updateUserPassword">
                    <label for="">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password_confirmation" class="form-control">
                    <label for="">Confirm Password</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    </div>
</div>

<script>
    var updateButtons = document.getElementsByClassName('button-update');
    var updateUserId = document.getElementById('updateUserId');
    var updateUserName = document.getElementById('updateUserName');
    var updateUserEmail = document.getElementById('updateUserEmail');

    for( let i = 0; i < updateButtons.length; i++ ) {
        updateButtons[i].addEventListener('click', function() {
            updateUserId.value = this.dataset.id;
            updateUserName.value = this.dataset.name;
            updateUserEmail.value = this.dataset.email;
        });
    }
</script>