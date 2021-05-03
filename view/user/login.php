<h1>
    Connectez-vous
</h1>

<form  id="connectForm" action="?ctrl=security&action=login" method="post">
    <p>
        <label for="mail">Votre email : </label><br>
        <input  class="uk-input uk-form-width-large"type="email" name="email" id="mail" required>
    </p>
    <p>
        <label for="pass">Votre mot de passe : </label><br>
        <input class="uk-input uk-form-width-large" type="password" name="password" id="pass" required>
    </p>
    <p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input class="uk-button uk-button-secondary" type="submit" name="submit" value="CONNEXION">
    </p>
</form>