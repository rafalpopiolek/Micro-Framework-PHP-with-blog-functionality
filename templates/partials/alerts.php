<?php

if (isset($_SESSION['message'])): ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: 'info',
            title: '<?= $_SESSION['message'] ?>'
        });
    </script>
    <?php
    // unset session after displaying
    unset($_SESSION['message']);
endif;
?>
