<form action="<?php echo base_url('test/test_act') ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="video" id="video">
    <button type="submit">Upload</button>
</form>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<div style="margin-top: 8px" id="message">
    <?php
    if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
    ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['tipe'] ?>',
                title: 'Notification',
                text: '<?php echo $_SESSION['pesan'] ?>',

            })
        </script>
    <?php
    }
    $_SESSION['pesan'] = '';

    ?>
</div>