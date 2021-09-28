<section class="contact_us">
    <div class="modal fade" id="modalRevisi" tabindex="-1" aria-labelledby="modalRevisi" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?php echo base_url('uploads/logo/LOGO.png') ?>" width="10%" alt="">
                    <h5 class="modal-title" id="exampleModalLabel">Input Pengajuan Revisi </h5>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" id="form_revisi">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Revisi </label>
                            <div class="col-sm-12 col-md-10">
                                <textarea class="form-control" required rows="3" name="revisi" id="revisi" placeholder="Tuliskan revisi anda pada kolom ini"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label"></label>
                            <div class="col-sm-12 col-md-10">
                                <button type="button" id="btnSubmit" class="btn btn-primary"></span>Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                        <input type="hidden" name="idOrder" id="idOrder">
                        <input type="hidden" name="id" id="id">
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $('#btnSubmit').click(function() {
        $('#form_revisi').validate({
            rules: {
                'checkbox': {
                    required: true
                }
            },
            highlight: function(input) {
                $(input).parents('label').addClass('has-error');
            },
            unhighlight: function(input) {
                $(input).parents('.validation').removeClass('has-error');
            }
        })
        var values = {

            idOrder: $('#idOrder').val(),
        }

        var formData = $('#form_revisi').serializeArray();
        var form = $('#form_revisi');
        for (field of formData) {
            values[field.name] = field.value;
        }
        if (form.valid()) {
            $.ajax({
                beforeSend: function() {
                    $('#btnSubmit').attr('disabled', true);
                    $('#btnSubmit').html('<i class="fa fa-spinner fa-spin"></i> Process');
                },
                url: '<?php echo base_url('order_pembacaan/save_revisi') ?>',
                type: 'POST',
                data: values,
                cache: false,
                dataType: 'JSON',
                success: function(response) {
                    $('#btnSubmit').html('<i class="fa fa-save"></i> Simpan');
                    $('#btnSubmit').attr('disabled', false);
                    if (response.status == 200) {
                        window.location = response.link;
                    } else {
                        $('#btnSubmit').attr('disabled', false);
                        alert(response.pesan);
                    }
                },
                error: function() {
                    alert("Gagal");
                    $('#btnSubmit').attr('disabled', false);
                }
            });
        } else {
            validationError();
        }
    });
</script>