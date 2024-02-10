<!-- Modal HTML -->
<div class="modal fade" id="borrowBooksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrow Books Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="<?= base_url('library/saveData') ?>" method="post">
                    <!-- Add your form fields and content here -->
                    <div class="form-group">
                        <label for="bookTitle">Book Title</label>
                        <input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Enter Book Title" required>
                        
                        <label for="bookNumber">Book Number</label>
                        <input type="text" class="form-control" id="bookNumber" name="bookNumber" placeholder="Enter Book Number" required>

                        <label for="studIDnum">Student ID Number</label>
                        <input type="text" class="form-control" id="studIDnum" name="studIDnum" placeholder="Enter Student ID Number" required>

                        <label for="studSec">Student Section</label>
                        <input type="text" class="form-control" id="studSec" name="studSec" placeholder="Enter Student Section" required> 

                        <label for="studYearLevel">Student Year Level</label>
                        <select class="form-control" id="studYearLevel" name="studYearLevel" required>
                            <option value="" disabled selected>Select Year Level</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                        </select>

                        <label for="dateBorrowed">Date Borrowed</label>
                        <input type="datetime-local" class="form-control" id="dateBorrowed" name="dateBorrowed" placeholder="Select Date Borrowed">

                        <label for="dateReturn">Date Return</label>
                        <input type="datetime-local" class="form-control" id="dateReturn" name="dateReturn" placeholder="Select Date Return">
                    </div>

                    <!-- Move the "Save changes" button inside the form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add modals for success and error directly in your main file -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-success text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Data has been successfully inserted.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-danger text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                An error occurred while inserting data. Please try again.
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Your existing HTML content, modals, and form -->

<!-- Add this script at the end of your file -->
<script>
    $(document).ready(function() {
        // Get the status from the URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        // Show the appropriate modal based on the status
        if (status === 'success') {
            $('#successModal').modal('show');

            // Automatically close the success modal after 2 seconds
            setTimeout(function() {
                $('#successModal').modal('hide');
            }, 2000);
        } else if (status === 'error') {
            $('#errorModal').modal('show');
        }
    });
</script>