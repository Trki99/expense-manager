<!-- Modal -->
<div class="modal fade" id="expenseUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Expense</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateExpenseForm" action="{{ route('update_expense') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input id="updateExpenseId" type="hidden" name="id" value="0">
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control" id="updateExpenseTitle">
                    <label for="">Title</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="amount" class="form-control" id="updateExpenseAmount">
                    <label for="">Amount</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="datetime-local" name="date" class="form-control" id="updateExpenseDate">
                    <label for="">Date</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="category" id="updateExpenseCategory">
                        <option id="updateDefaultOption" value="">Category</option>
                        @foreach ($expenseCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="">Expense Category</label>
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
    var updateExpenseId = document.getElementById('updateExpenseId');
    var updateExpenseTitle = document.getElementById('updateExpenseTitle');
    var updateExpenseAmount = document.getElementById('updateExpenseAmount');
    var updateExpenseDate = document.getElementById('updateExpenseDate');
    var updateDefaultOption = document.getElementById('updateDefaultOption');
    var selectOptions = document.querySelectorAll('#updateExpenseForm #updateExpenseCategory>option');

    for( let i = 0; i < updateButtons.length; i++ ) {
        updateButtons[i].addEventListener('click', function() {
            updateExpenseId.value = this.dataset.id;
            updateExpenseTitle.value = this.dataset.title;
            updateExpenseAmount.value = this.dataset.amount;
            updateExpenseDate.value = this.dataset.date;

            for( var j = 0; j < selectOptions.length; j++ ){
                if( selectOptions[j].innerText == this.dataset.category ) {
                    updateDefaultOption.value = selectOptions[j].value;
                }
            }

        });
    }
</script>