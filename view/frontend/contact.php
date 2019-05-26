<?php
ob_start();
?>
<?php if (isset($success)): ?>  
<div class="alert alert-success">
  Le message a bien été envoyé
</div>
<?php endif ?>
<form name="sentMessage" id="contactForm" action="" method="POST">
  <div class="control-group">
    <div class="form-group floating-label-form-group controls">
      <label>Nom</label>
      <input type="text" class="form-control" placeholder="Nom" id="name" name="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>">
    </div>
    <?php if (isset($errors) && in_array($contactValidator::NAME_EMPTY, $errors)): ?>
    <span class="msg-error text-danger"><?= $contactValidator::NAME_EMPTY ?></span>
    <?php endif ?>
  </div>
  <div class="control-group">
    <div class="form-group floating-label-form-group controls">
      <label>Adresse Email</label>
      <input type="email" class="form-control" placeholder="Adresse Email" id="email" name="mail" value="<?= (isset($_POST['mail'])) ? $_POST['mail'] : '' ?>">
    </div>
    <?php if (isset($errors) && in_array($contactValidator::MAIL_EMPTY, $errors)): ?>
    <span class="msg-error text-danger"><?= $contactValidator::MAIL_EMPTY ?></span>
    <?php endif ?>
  </div>
  <div class="control-group">
    <div class="form-group floating-label-form-group controls">
      <label>Message</label>
      <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message"><?= (isset($_POST['message'])) ? $_POST['message'] : '' ?></textarea>
    </div>
    <?php if (isset($errors) && in_array($contactValidator::MESSAGE_EMPTY, $errors)): ?>
    <span class="msg-error text-danger"><?= $contactValidator::MESSAGE_EMPTY ?></span>
    <?php endif ?>
  </div>
  <br>
  <div class="form-group">
    <button type="submit" class="btn btn-primary" id="sendMessageButton" name="contact">Envoyer</button>
  </div>
</form>
<?php
$content = ob_get_clean();
require('view/template/page.php');
?>