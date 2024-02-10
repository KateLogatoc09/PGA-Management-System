<!-- Modal HTML -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Address Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <form action="/saveaddress" method="post">
                    <!-- Add your form fields and content here -->

                    <div class="form-group">
                
                                        <input type="hidden" class="form-control" name="id"
                                        value="<?php if (isset($address['id'])) {echo $address['id'];}?>">
                        
                                        <label for="type">Type of Address:</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="Permanent">Permanent</option>
                                            <option value="Mailing">Mailing</option>
                                        </select>

                                    <label for="address">Address:</label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter Address">
                        

                            
                                    <label for="postal_code">Postal Code:</label>
                                        <input type="number" class="form-control" name="postal_code" placeholder="Enter Postal Code">
                        
                            
                                    <label for="tel_num">Telephone Number:</label>
                                        <input type="number" class="form-control" name="tel_num" max_length="11" placeholder="Enter Telephone Number">

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
