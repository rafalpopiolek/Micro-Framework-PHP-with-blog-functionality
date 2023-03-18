<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>Venture Labs - Recruitment Task</title>
</head>
<body>

<?php
include_once VIEW_PATH . '/layouts/sections/navigation.php' ?>

<div class="container p-5">
    <?php
    include VIEW_PATH . $this->view . '.php' ?>
</div>

<?php
include_once VIEW_PATH . '/layouts/sections/footer.php' ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.jqueryui.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Fetch all blogs for datatable
        $('#blogsTable').DataTable({
            serverSide: true,
            ajax: '/blog/?action=load',
            orderMulti: false,
            columns: [
                {data: "username"},
                {data: "text"},
                {
                    sortable: false,
                    data: row => `
                    <div class="d-flex flex-">
                        <button class="ms-2 btn btn-outline-primary btn-sm edit-category-btn">
                            Edit
                        </button>&nbsp;
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="${row.id}">
                        <button class="btn btn-outline-primary btn-sm delete-btn" data-id="${row.id}">
                            Delete
                        </button>
                    </div>
                `
                }
            ]
        });

        // Delete blog
        document.querySelector('#blogsTable').addEventListener('click', async function (event) {
            const deleteButton = event.target.closest('.delete-btn')

            if (deleteButton) {
                const id = deleteButton.getAttribute('data-id')

                const response = await fetch('/blog/?action=delete', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({id}),
                });

                const data = await response.json();

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

                if (data.status === 200) {
                    deleteButton.closest('tr').remove();
                    Toast.fire({
                        icon: 'success',
                        title: 'Blog deleted successfully'
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Cannot delete blog'
                    });
                }
            }
        })

    });
</script>
</body>
</html>
