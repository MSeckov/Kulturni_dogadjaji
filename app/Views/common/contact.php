<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact us</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      Phone: <i class="fas fa-phone mt-4 fa-2x"></i> 011/111-222
      <br>
      Email: <i class="fas fa-envelope mt-4 fa-2x"></i> seckovic1.mirosalv@gmail.com
      <hr>
        <form method="post" action="<?=route_to('send')?>">
            <?= csrf_field() ?>
          <div class="mb-3">
            <label for="sender-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="sender-name" placeholder="Enter your name" name="sender">
          </div>
          <div class="mb-3">
            <label for="sender-email" class="col-form-label">E mail:</label>
            <input type="email" class="form-control" id="sender-email" placeholder="Enter your email" name="senderEmail">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" placeholder="Your message" name="senderMessage"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Send message">
        </div>
        </form>
      </div>
     
    </div>
  </div>
</div>