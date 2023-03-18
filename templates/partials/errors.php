<?php

if (isset($_SESSION['errors'])): ?>
    <div class="alert alert-danger border border-dark" role="alert">
        <strong>
            <?php if(is_string($_SESSION['errors'])): ?>
                <?= $_SESSION['errors'] ?>
            <?php elseif(is_array($_SESSION['errors'])): ?>
                <?php foreach ($_SESSION['errors'] as $errors): ?>
                    <?php foreach ($errors as $error): ?>
                        <?= $error ?>
                        <br>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php else: ?>
                Error occured
            <?php endif; ?>
        </strong>
    </div>

<?php
    unset($_SESSION['errors']);
    endif;
?>
