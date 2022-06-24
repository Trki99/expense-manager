<!-- Modal -->
<div class="modal fade" id="categoryUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('update_category') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input id="updateCategoryId" type="hidden" name="id" value="0">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="updateCategoryName">
                    <label for="">Category Name</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="group" id="updateCategoryGroup">
                        <option id="updateDefaultOption" value="">Group</option>
                        <option value="Income">Income</option>
                        <option value="Expense">Expense</option>
                    </select>
                    <label for="updateCategoryGroup">Category Group</label>
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
    var updateCategoryId = document.getElementById('updateCategoryId');
    var updateCategoryName = document.getElementById('updateCategoryName');
    var updateDefaultOption = document.getElementById('updateDefaultOption');

    for( let i = 0; i < updateButtons.length; i++ ) {
        updateButtons[i].addEventListener('click', function() {
            updateCategoryId.value = this.dataset.id;
            updateCategoryName.value = this.dataset.name;
            updateDefaultOption.value = this.dataset.group;
        });
    }
</script>