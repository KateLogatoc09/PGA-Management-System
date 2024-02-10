<!-- Modal HTML -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Teacher Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="/saveteacher" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group">
                        <label for="idnum">ID number:</label>
                        <input type="hidden" name="id" value="<?php if (isset($teach['id'])) {echo $teach['id'];}?>">
                        <input type="text" class="form-control" name="idnum" placeholder="Enter ID number" 
                        value="<?= isset($teach['idnum']) ? $teach['idnum'] : '' ?>">
                                 
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" name="fname" placeholder="Enter First Name"
                        value="<?php if (isset($teach['fname'])) {echo $teach['fname'];}?>">

                        <label for="mname">Middle Name:</label>
                        <input type="text" class="form-control" name="mname" placeholder="Enter Middle Name" 
                        value="<?php if (isset($teach['mname'])) {echo $teach['mname'];}?>">

                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" 
                        value="<?php if (isset($teach['lname'])) {echo $teach['lname'];}?>">
                                 
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" name="dob" placeholder="Enter Date of Birth" 
                        value="<?php if (isset($teach['dob'])) {echo $teach['dob'];}?>">

                    </div>
                    
                    <!-- Add other form fields as needed -->
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
