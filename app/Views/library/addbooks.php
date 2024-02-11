<!-- Your view content goes here -->
<!-- Modal HTML -->
<div class="modal fade" id="addBooksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Books Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Update the form action and method -->
                <form action="/saveBook" method="post">
                    <!-- Add your form fields and content here -->
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id"
                        value="<?php if (isset($book['id'])) {echo $book['id'];}?>">
                        
                        <label for="bookTitle">Book Title</label>
                        <input type="text" class="form-control" id="bookTitle" name="bookTitle" placeholder="Enter Book Title" required>

                        <label for="bookNumber">Book Number</label>
                        <input type="text" class="form-control" id="bookNumber" name="bookNumber" placeholder="Enter Book Number" required>

                        <label for="bookAuthor">Book Author</label>
                        <input type="text" class="form-control" id="bookAuthor" name="bookAuthor" placeholder="Enter Book Author" required>

                        <label for="datePublish">Date Publish</label>
                        <input type="date" class="form-control" id="datePublish" name="datePublish" placeholder="Enter Date Publish" required>
                    </div>

                    <!-- Add other form fields as needed -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
