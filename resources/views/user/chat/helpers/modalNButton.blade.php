<div class="fixed-action-btn">
  <a class="waves-effect waves-light btn-floating modal-trigger btn-large cayn" href="#addMessage" id="openMessageModal">
    <i class="large material-icons">insert_comment</i>
  </a>
</div>

<div id="addMessage" class="modal grey darken-4">
  <div class="modal-content">
    <h4 class="white-text">Add Message</h4>
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">mode_edit</i>
        <textarea id="messageTextarea" class="materialize-textarea white-text" autofocus></textarea>
        <label for="messageTextarea">say what you want</label>
      </div>
      <b class="amber-text text-lighten-3">* click enter to send a message</b>
    </div>
  </div>
  <div class="modal-footer grey darken-4">
    <a href="#!" class="modal-close waves-effect waves-red btn-flat white-text">Close</a>
  </div>
</div>
