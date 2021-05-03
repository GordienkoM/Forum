
<h1>
    Inscrivez-vous !!
</h1>
<form id = "inscriptionForm" action="?ctrl=security&action=register" method="post">
    <p>
        <label for="pseudo">Votre pseudo : </label><br>
        <input class="uk-input uk-form-width-large" type="text" name="pseudo" id="pseudo" required>
    </p>
    <p>
        <label for="mail">Votre email : </label><br>
        <input class="uk-input uk-form-width-large" type="email" name="email" id="mail" required>
    </p>
    <p>
        <label for="pass">Votre mot de passe : </label><br>
        <input class="uk-input uk-form-width-large" type="password" name="password" id="pass" required>
    </p>
    <p>
        <label for="passr">Ressaisir votre mot de passe : </label><br>
        <input class="uk-input uk-form-width-large" type="password" name="password_repeat" id="passr" required>
    </p>
    <p>
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <input class="uk-button uk-button-secondary" type="submit" name="submit" value="S'INSCRIRE">
    </p>
</form>