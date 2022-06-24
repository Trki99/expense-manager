<!-- Modal -->
<div class="modal fade" id="categoryDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modalCategoryForm" action="{{ route('delete_category') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input id="deleteCategoryId" type="hidden" name="category_id" value="0">
                    <input id="deleteCategoryGroup" type="hidden" name="category_group" value="">
                    <label for="reassign_category">Choose a category where your incomes/expenses will transfer from deleted one. Otherwise, they will be assigned to the default category.</label>
                    <select name="reassign_category" class="reassign_category d-block">
                        <option id="deleteDefaultOption" value="">Category</option>
                        @foreach( $categories as $cat ) 
                            <option class="{{ $cat->group }}" value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var deleteCategoryId = document.getElementById('deleteCategoryId');
    var deleteCategoryGroup = document.getElementById('deleteCategoryGroup');
    var deleteButtons = document.getElementsByClassName('button-delete');
    var selectOptions = document.querySelectorAll('#modalCategoryForm .reassign_category>option');
    var deleteDefaultOption = document.getElementById('deleteDefaultOption');

    for( var i = 0; i < deleteButtons.length; i++ ) {
        deleteButtons[i].addEventListener('click', function () {
            deleteCategoryId.value = this.dataset.categoryId;
            deleteCategoryGroup.value = this.dataset.categoryGroup;

            for( var j = 0; j < selectOptions.length; j++ ){
                if( selectOptions[j].value == this.dataset.categoryId || selectOptions[j].className != this.dataset.categoryGroup ) {
                    selectOptions[j].hidden = true;
                }
                else if( selectOptions[j].hidden ) {
                    selectOptions[j].hidden = false;
                }
            }

            if(deleteCategoryGroup.value == 'Income') {
                deleteDefaultOption.value = selectOptions[1].value;
            } else if(deleteCategoryGroup.value == 'Expense') {
                deleteDefaultOption.value = selectOptions[2].value;
            }
        });
    }
</script>