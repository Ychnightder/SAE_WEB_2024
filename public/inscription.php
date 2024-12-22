<?php
require"../src/php/views/headerAC.php";
session_start();

?>
<div class="leftBox">
    <div class="logoBox">
        <a href="index.php">
            <img src="./assets/image/shared/logo.png" alt="logo autisme france"
            /></a>
    </div>
    <h1 class="title-AC">
        Bienvenue sur l'intranet <br />d'Autisme France
    </h1>
    <div class="formBox">
        <div class="div-form-inscription">
            <form
                    class="form-inscription"

                    method="post"
                action="index.php?action=register_user"
            >

                <div class="first-info">
                    <div class="name-firsname">
                        <label for="nom">
                            Nom :
                            <input class="<?= isset($_SESSION['register_errors']['nom']) ? 'error' : '' ?>" type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required />
                            <span class="error-message"><?= $_SESSION['register_errors']['nom'] ?? '' ?></span>

                        </label>
                        <label for="prenom">
                            Prenom :
                            <input  class="<?= isset($_SESSION['register_errors']['prenom']) ? 'error' : '' ?>" type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required />
                            <span class="error-message"><?= $_SESSION['register_errors']['prenom'] ?? '' ?></span>

                        </label>
                    </div>
                    <label for="Email">
                        Adresse mail :
                        <input class="<?= isset($_SESSION['register_errors']['email']) ? 'error' : '' ?>" id="Email" type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
                        <span class="error-message"><?= $_SESSION['register_errors']['email'] ?? '' ?></span>

                    </label>

                    <label for="pwd">
                        Mot de passe :
                        <input class="<?= isset($_SESSION['register_errors']['password']) ? 'error' : '' ?>" id="pwd" type="password" name="password" value="<?= htmlspecialchars($_POST['password'] ?? '') ?>" required />
                        <span class="error-message"><?= $_SESSION['register_errors']['password'] ?? '' ?></span>
                    </label>

                    <div class="divSubmit">
                        <button type="reset" class="return-btn">Retour</button>
                        <button type="button" class="btn-suivant">Suivant</button>
                    </div>
                </div>
                <div class="second-info">
                    <label for="voie">
                        Voie :
                        <input   class="<?= isset($_SESSION['register_errors']['voie']) ? 'error' : '' ?>" type="text" value="<?= htmlspecialchars($_POST['voie'] ?? '') ?>" id="voie" name="voie" required />
                        <span class="error-message">
            <?= $_SESSION['register_errors']['voie'] ?? '' ?>
        </span>

                    </label>
                    <div class="info-position">
                        <label for="codepostale">
                            Code de postale :
                            <input class="<?= isset($_SESSION['register_errors']['codepostale']) ? 'error' : '' ?>"
                                id="codepostale"
                                   required
                                type="number"
                                name="codepostale"
                                value="<?= htmlspecialchars($_POST['codepostale'] ?? '') ?>"
                            />
                            <span class="error-message">
                <?= $_SESSION['register_errors']['codepostale'] ?? '' ?>
            </span>

                        </label>
                        <label for="ville">
                            Ville :
                            <input   class="<?= isset($_SESSION['register_errors']['ville']) ? 'error' : '' ?>" type="text"  value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>" id="ville" name="ville" required />
                            <span class="error-message">
                <?= $_SESSION['register_errors']['ville'] ?? '' ?>
            </span>

                        </label>
                    </div>
                    <label for="pays">
                        Pays :
                        <select  class="<?= isset($_SESSION['register_errors']['pays']) ? 'error' : 'select-pays' ?>" required name="pays" id="pays">


                            <option selected  <?= isset($_POST['pays']) && $_POST['pays'] == 'France' ? 'selected' : '' ?> name="pays">
                                France
                            </option>
                        </select>
                        <span class="error-message">
            <?= $_SESSION['register_errors']['pays'] ?? '' ?>
        </span>

                    </label>
                    <label for="telephone">
                        Téléphone :
                        <input  class="<?= isset($_SESSION['register_errors']['telephone']) ? 'error' : '' ?>" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" id="telephone" type="number" name="telephone" />
                        <span class="error-message">
            <?= $_SESSION['register_errors']['telephone'] ?? '' ?>
        </span>

                    </label>

                    <div class="divSubmit">
                        <button class="return-btn2" type="button" >Retour</button>
                        <button type="submit">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
   
<?php
require "../src/php/views/footerAC.php";
unset($_SESSION['register_errors']);
?>