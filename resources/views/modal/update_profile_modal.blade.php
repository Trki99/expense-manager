<!-- Modal -->
<div class="modal fade" id="profileUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateProfileForm" action="{{ route('update_profile') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="updateProfileName">
                    <label for="">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="updateProfileEmail">
                    <label for="">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control" id="updateProfilePassword">
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
    var updateProfileName = document.getElementById('updateProfileName');
    var updateProfileEmail = document.getElementById('updateProfileEmail');

    for( let i = 0; i < updateButtons.length; i++ ) {
        updateButtons[i].addEventListener('click', function() {
            updateProfileName.value = this.dataset.name;
            updateProfileEmail.value = this.dataset.email;
        });
    }
</script>