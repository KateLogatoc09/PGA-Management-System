<!-- Modal HTML -->
<div class="modal fade" id="learnerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Learner Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="/save" method="post" enctype="multipart/form-data">
                    <!-- Add your form fields and content here -->

                    <div class="form-group">
                
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($learner['id'])) {echo $learner['id'];}?>">
                        
                                        <center>
                                        <?php if(isset($photo)): ?>
                                            <img
                                            src="<?= $photo ?>"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        <?php else: ?>
                                            <img
                                            src="<?= base_url() ?>img/user-1.jpg"
                                            alt="user-avatar"
                                            class="d-block rounded"
                                            height="100"
                                            width="100"
                                            id="uploadedAvatar"
                                            />
                                        <?php endif; ?>
                                    <div class="button-wrapper my-4">
                                    <label for="upload" class="btn btn-primary mb-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        hidden
                                        accept="image/png, image/jpeg"
                                        name="photo"
                                        />
                                    </label>
                                    </div>
                                    </center>

                                    <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter First Name">
                        

                            
                                    <label for="middle_name">Middle Name:</label>
                                        <input type="text" class="form-control" name="middle_name" placeholder="Enter Middle Name">
                        

                            
                                    <label for="last_name">Last Name:</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name">
                        

                            
                                    <label for="nickname">Nickname:</label>
                                        <input type="text" class="form-control" name="nickname" placeholder="Enter Nickname">
                        

                            
                                    <label for="age">Age:</label>
                                        <input type="number" class="form-control" name="age" placeholder="Enter Age">
                        

                            
                                    <label for="gender">Gender:</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                        

                                        <label for="marital_status">Marital Status:</label>
                                            <select class="form-control" name="marital_status" id="marital_status">
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Separated">Separated</option>
                                            <option value="Widow">Widow</option>
                                        </select>
                            
                                    <label for="birthdate">Birthdate:</label>
                                        <input type="date" class="form-control" name="birthdate" placeholder="Enter Birthdate">
                        

                            
                                    <label for="birthplace">Birthplace:</label>
                                        <input type="text" class="form-control" name="birthplace" placeholder="Enter Birthplace">

                            
                                    <label for="last_name">Mobile Number:</label>
                                        <input type="number" class="form-control" name="mobile_num" max_length="11" placeholder="Enter Mobile Number">
                        
                            
                                    <label for="last_name">Nationality:</label>
                                        <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality">
                        

                            
                                    <label for="last_name">Religion:</label>
                                        <input type="text" class="form-control" name="religion" placeholder="Enter Religion">
                        

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
