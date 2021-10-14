<div class="modal fade" id="exampleModalLogin" tabindex="-1" aria-labelledby="exampleModalLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?php echo base_url('uploads/logo/LOGO.png') ?>" width="10%" alt="">
                <h5 class="modal-title" id="exampleModalLabel">Login ke Akun Anda</h5>
                <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table style="vertical-align: top;" width="100%">
                    <a href=""><img src="<?php echo base_url('uploads/google button.png')?>" alt=""></a>
                </table>

            </div>
        </div>
    </div>
</div>


<script>
    function hideModalLogin() {
        $('#exampleModalLogin').modal('hide');
    }
</script>