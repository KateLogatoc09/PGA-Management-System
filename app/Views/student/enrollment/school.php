<!-- Modal HTML -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">School Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="/saveschool" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($school['id'])) {echo $school['id'];}?>">

                                    <label for="grade">Grade/Year:</label>
                                        <select class="form-control" name="grade" id="grade">
                                        <option value="Pre-School (Kinder)">Pre-School (Kinder)</option>
                                        <option value="Grade School (G1-G3)">Grade School (G1-G3)</option>
                                        <option value="Grade School (G4-G6)">Grade School (G4-G6)</option>
                                        <option value="Junior High School (G7-G10)">Junior High School (G7-G10)</option>
                                    </select>

                                    <label for="school_name">School Name:</label>
                                        <input type="text" class="form-control" name="school_name" placeholder="Enter Name of School">

                                    <label for="level">Level:</label>
                                        <input type="text" class="form-control" name="level" placeholder="Enter Level">
                               
                                    <label for="period">Period Covered:</label>
                                        <input type="text" class="form-control" name="period" placeholder="Enter Period Covered">

                               
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
