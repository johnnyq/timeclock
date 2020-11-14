<div class="modal" id="editPunchModal<?php echo $punch_id; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Punch</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="post.php" method="post">
        <input type="hidden" name="punch_id" value="<?php echo $punch_id; ?>">
        <input type="hidden" name="current_uri" value="<?php echo $current_uri; ?>">
        <input type="hidden" name="date" value="<?php echo $date_edit; ?>">
        <div class="modal-body">    
          
          <div class="form-group">
            <label>Time In</label>
            <input type="time" class="form-control" name="time_in" value="<?php echo $time_in_edit; ?>">
          </div>

          <div class="form-group">
            <label>Time Out</label>
            <input type="time" class="form-control" name="time_out" value="<?php echo $time_out_edit; ?>">
          </div>

        </div>
        <div class="modal-footer bg-white">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="edit_punch" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>