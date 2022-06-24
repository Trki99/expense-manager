<!-- Modal -->
<div class="modal fade" id="incomeUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Income</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateIncomeForm" action="{{ route('update_income') }}" method="POST">
            @csrf
            <div class="modal-body">
                <input id="updateIncomeId" type="hidden" name="id" value="0">
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control" id="updateIncomeTitle">
                    <label for="">Title</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="amount" class="form-control" id="updateIncomeAmount">
                    <label for="">Amount</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="datetime-local" name="date" class="form-control" id="updateIncomeDate">
                    <label for="">Date</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="category" id="updateIncomeCategory">
                        <option id="updateDefaultOption" value="">Category</option>
                        @foreach ($incomeCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="">Income Category</label>
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
    var updateIncomeId = document.getElementById('updateIncomeId');
    var updateIncomeTitle = document.getElementById('updateIncomeTitle');
    var updateIncomeAmount = document.getElementById('updateIncomeAmount');
    var updateIncomeDate = document.getElementById('updateIncomeDate');
    var updateDefaultOption = document.getElementById('updateDefaultOption');
    var selectOptions = document.querySelectorAll('#updateIncomeForm #updateIncomeCategory>option');

    for( let i = 0; i < updateButtons.length; i++ ) {
        updateButtons[i].addEventListener('click', function() {
            updateIncomeId.value = this.dataset.id;
            updateIncomeTitle.value = this.dataset.title;
            updateIncomeAmount.value = this.dataset.amount;
            updateIncomeDate.value = this.dataset.date;

            for( var j = 0; j < selectOptions.length; j++ ){
                if( selectOptions[j].innerText == this.dataset.category ) {
                    updateDefaultOption.value = selectOptions[j].value;
                }
            }

        });
    }
</script>