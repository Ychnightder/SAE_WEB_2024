<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();

$errors = $_SESSION['register_errors'] ?? [];
$oldInputs = $_SESSION['old_inputs'] ?? [];
unset($_SESSION['register_errors'], $_SESSION['old_inputs']);
require "../src/php/views/headerAC.php";
?>

<div class="leftBox">
    <div class="logoBox">
        <a href="index.php">
            <img src="./assets/image/shared/logo.png" alt="logo autisme france" />
        </a>
    </div>
    <h1 class="title-AC">
        Bienvenue sur l'intranet <br />d'Autisme France <br /> <br />
    </h1>

    <?php if (!empty($errors)) : ?>
        <div class="error-message-general-2">
            <?php
            foreach ($errors as $error) {
                echo "<p>" . htmlspecialchars($error) . "</p>";
            }
            ?>
        </div>
    <?php endif; ?>
    <div class="formBox">
        <div class="div-form-inscription">
            <form class="form-inscription" method="post" action="index.php?action=register_user">

                <div class="first-info">
                    <div class="name-firsname">
                        <label for="nom">
                            Nom :
                            <input class="<?= isset($errors['nom']) ? 'error' : '' ?>" type="text" id="nom" name="nom" value="<?= htmlspecialchars($oldInputs['nom'] ?? '') ?>" required />
                            <span class="error-message"></span>
                        </label>
                        <label for="prenom">
                            Prénom :
                            <input class="<?= isset($errors['prenom']) ? 'error' : '' ?>" type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($oldInputs['prenom'] ?? '') ?>" required />
                            <span class="error-message"></span>
                        </label>
                    </div>

                    <label for="Email">
                        Adresse mail :
                        <input class="<?= isset($errors['email']) ? 'error' : '' ?>" id="Email" type="email" name="email" value="<?= htmlspecialchars($oldInputs['email'] ?? '') ?>" required />
                        <span class="error-message"></span>
                    </label>

                    <label for="pwd">
                        Mot de passe :
                        <input class="<?= isset($errors['password']) ? 'error' : '' ?>" id="pwd" type="password" name="password" value="<?= htmlspecialchars($oldInputs['password'] ?? '') ?>" required />
                        <span class="error-message"></span>
                    </label>

                    <div class="divSubmit">
                        <button type="reset" class="return-btn">Retour</button>
                        <button type="button" class="btn-suivant">Suivant</button>
                    </div>
                </div>

                <div class="second-info">
                    <label for="voie">
                        Voie :
                        <input class="<?= isset($errors['voie']) ? 'error' : '' ?>" type="text" value="<?= htmlspecialchars($oldInputs['voie'] ?? '') ?>" id="voie" name="voie" required />
                        <span class="error-message"></span>
                    </label>

                    <div class="info-position">
                        <label for="codepostale">
                            Code postal :
                            <input class="<?= isset($errors['codepostale']) ? 'error' : '' ?>" id="codepostale" required type="number" name="codepostale" value="<?= htmlspecialchars($oldInputs['codepostale'] ?? '') ?>" />
                            <span class="error-message"></span>
                        </label>

                        <label for="ville">
                            Ville :
                            <input class="<?= isset($errors['ville']) ? 'error' : '' ?>" type="text" value="<?= htmlspecialchars($oldInputs['ville'] ?? '') ?>" id="ville" name="ville" required />
                            <span class="error-message"></span>
                        </label>
                    </div>

                    <label for="pays">
                        Pays :
                        <select class="<?= isset($errors['pays']) ? 'error' : 'select-pays' ?>" required name="pays" id="pays">
                            <option <?= isset($oldInputs['pays']) && $oldInputs['pays'] == 'France' ? 'selected' : '' ?> value="France">France</option>
                        </select>
                        <span class="error-message"></span>
                    </label>

                    <label for="telephone">
                        Téléphone :
                        <input class="<?= isset($errors['telephone']) ? 'error' : '' ?>" value="<?= htmlspecialchars($oldInputs['telephone'] ?? '') ?>" id="telephone" type="number" name="telephone" />
                        <span class="error-message"></span>
                    </label>

                    <div class="divSubmit">
                        <button class="return-btn2" type="button">Retour</button>
                        <button type="submit" class="sub-inscription">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require "../src/php/views/footerAC.php";
unset($_SESSION['register_errors'], $_SESSION['old_inputs']);
?>
