<div class="modal" id="addPunchModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Punch</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="post.php" method="post">
        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
        <input type="hidden" name="current_uri" value="<?php echo $current_uri; ?>">
        <div class="modal-body">    
          
          <div class="form-group">
            <label>Date</label>
            <input type="date" class="form-control" name="date" required>
          </div>

          <div class="form-group">
            <label>Time In</label>
            <input type="time" class="form-control" name="time_in" required>
          </div>

          <div class="form-group">
            <label>Time Out</label>
            <input type="time" class="form-control" name="time_out">
          </div>

        </div>
        <div class="modal-footer bg-white">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="add_punch" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>