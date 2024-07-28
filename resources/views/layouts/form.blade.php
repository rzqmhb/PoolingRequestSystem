<div class="card">
    <div class="card-body">
        <h5 class="card-title">Create New Request</h5>

        <!-- Vertically centered Modal -->
        <!-- Large Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
            Add
        </button>

        <div class="modal fade" id="largeModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST", action="{{route('requests.store')}}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vehicle</label>
                                <div class="col-sm-10">
                                    <select name="vehicle" class="form-select" aria-label="Default select example">
                                        <option selected>Select a vehicle</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{$vehicle->id}}">{{$vehicle->vehicle_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Approvers</label>
                                <div class="col-sm-10">
                                    <select name="approver1" id="approver1" class="form-select" aria-label="Default select example">
                                        <option selected value="-1">Approver 1</option>
                                        @foreach ($approvers as $approver)
                                            <option value="{{$approver->id}}">{{$approver->user_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <select name="approver2" id="approver2" class="form-select" aria-label="Default select example">
                                        <option selected value="-2">Approver 2</option>
                                        @foreach ($approvers as $approver)
                                            <option value="{{$approver->id}}">{{$approver->user_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Driver Name</label>
                                <div class="col-sm-10">
                                    <input name="driver" type="text" class="form-control" placeholder="driver name here...">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Fuel Estimation</label>
                                <div class="col-sm-10">
                                    <input name="fuel_estimation" type="number" step="0.01" class="form-control" placeholder="fuel estimation here...">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Start Date</label>
                                <div class="col-sm-10">
                                    <input name="start_date" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-10">
                                    <input name="end_date" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Request</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div><!-- End Large Modal-->

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const approver1Select = document.getElementById('approver1');
    const approver2Select = document.getElementById('approver2');

    function disableSelectedOptions() {
        const approver1Value = approver1Select.value;
        const approver2Value = approver2Select.value;

        // Enable all options first
        for (let option of approver1Select.options) {
            option.disabled = false;
        }
        for (let option of approver2Select.options) {
            option.disabled = false;
        }

        // Disable the selected option in the other select
        if (approver1Value && approver1Value != '-1') {
            const approver2Option = approver2Select.querySelector(`option[value="${approver1Value}"]`);
            if (approver2Option) {
                approver2Option.disabled = true;
            }
        }
        if (approver2Value && approver2Value != '-2') {
            const approver1Option = approver1Select.querySelector(`option[value="${approver2Value}"]`);
            if (approver1Option) {
                approver1Option.disabled = true;
            }
        }
    }

    approver1Select.addEventListener('change', disableSelectedOptions);
    approver2Select.addEventListener('change', disableSelectedOptions);
});
</script>

