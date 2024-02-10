<!-- Modal HTML -->
<div class="modal fade" id="FamilyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Parent Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="/savefamily" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group">  
                    <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($family['id'])) {echo $family['id'];}?>">
                    <label for="relation">Relationship To Student:</label>
                        <select class="form-control" name="relation" id="relation">
                        <option value="Mother">Mother</option>
                        <option value="Father">Father</option>
                        <option value="Guardian">Guardian</option>
                    </select>

                                    <label for="fullname">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name">
                                 

                                    <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                 

                                    <label for="occupation">Occupation:</label>
                                        <input type="text" class="form-control" name="occupation" placeholder="Occupation">
                                 
                               
                                    <label for="res_add">Residential Address:</label>
                                        <input type="text" class="form-control" name="res_add" placeholder="Enter Residential Address">
                                 

                                    <label for="off_add">Office Address:</label>
                                        <input type="text" class="form-control" name="off_add" placeholder="Enter Office Address">
                                 
                                
                                    <label for="mob_num">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mob_num" max_length="11" placeholder="Enter Mobile Number">
                                 

                                    <label for="off_num">Office Number:</label>
                                        <input type="number" class="form-control" name="off_num" max_length="11" placeholder="Enter Office Number">
                                 

                               
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
