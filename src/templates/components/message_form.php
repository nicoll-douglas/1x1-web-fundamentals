<form
  id="message-form"
  aria-labelledby="leave-a-message-heading"
  action="/api/messages.php"
  method="POST">
  <label for="message-input" id="message-label">Message:</label>
  <div>
    <input id="message-input" name="message" type="text" required maxlength="255">
    <button type="submit">Submit</button>
  </div>
</form>