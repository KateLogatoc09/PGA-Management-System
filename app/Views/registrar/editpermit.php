<!-- Modal HTML -->
<div class="modal fade" id="permitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Permit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="/saveRegpermit" method="post">
                    <!-- Add your form fields and content here -->
                    <div class="form-group">
                    <input type="hidden" class="form-control" name="id"
                        value="<?php if (isset($pe['id'])) {echo $pe['id'];}?>">

                        <input type="hidden" name="id" value="<?php if (isset($pe['id'])) {echo $pe['id'];}?>">
                        <label for="quarter">Quarter:</label>
                        <input type="number" class="form-control" name="quarter" placeholder="Enter Quarter" 
                        value="<?php if (isset($pe['quarter'])) {echo $pe['quarter'];}?>">

                        <label for="date">Date:</label>
                        <input type="datetime-local" class="form-control" name="date" placeholder="Enter Date" 
                        value="<?php if (isset($pe['date'])) {echo $pe['date'];}?>">

                        <label for="status">Status:</label>
                                        <select class="form-control" name="status" id="status">
                                        <option value="">Status</option>
                                            <option value="PENDING">Pending</option>
                                            <option value="APPROVED">Approved</option>
                                            <option value="REJECTED">Rejected</option>
                                        </select>

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