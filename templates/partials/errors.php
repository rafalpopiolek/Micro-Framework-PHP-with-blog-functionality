<?php

if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger border border-dark" role="alert">
        <strong>
            <?php
            foreach ($_SESSION['errors'] as $errors): ?>
                <?php
                foreach ($errors as $error): ?>
                    <?= $error ?>
                    <br>
                <?php
                endforeach; ?>
            <?php
            endforeach; ?>
        </strong>
    </div>

<?php
    unset($_SESSION['errors']);
    endif;
?>
