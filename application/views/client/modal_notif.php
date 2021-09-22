<div class="modal fade" id="modalNotifikasi" tabindex="-1" aria-labelledby="modalNotifikasi" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <div>
                    <img src="<?php echo base_url('uploads/logo/LOGO.png') ?>" width="10%" alt="">
                    <p><strong>RKG DIGITAL INDONESIA</strong></p>
                </div>
            </div>
            <?php $gambar = $this->db->get_where('users', array('id' => $_SESSION['id']))->row(); ?>
            <h5 class="modal-title" style="margin-left: 10px;" id="exampleModalLabel">Mohon lengkapi data diri anda</h5>
            <div class="modal-body">
                <table style="vertical-align: top;" width="100%">
                    <form method="POST" action="<?= base_url('dashboard/lengkapi_data') ?>" enctype="multipart/form-data">
                        <tr>
                            <td>
                                <label for="foto_ktp">Nama Lengkap<em style="color:red">*</em> <?php echo form_error('nama') ?></label>
                                <input type="text" required class="form-control tanya" name="nama" readonly id="nama" value="<?= $gambar->nama ?>" placeholder="Nama">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="foto_ktp">Tempat Lahir<em style="color:red">*</em> <?php echo form_error('tempat_lahir') ?></label>
                                <input type="text" required class="form-control tanya" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?= $gambar->tempat ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="foto_ktp">Tanggal Lahir<em style="color:red">*</em> <?php echo form_error('tanggal_lahir') ?></label>
                                <input type="date" required class="form-control tanya" name="tanggal_lahir" id="tanggal_lahir" placeholder="Nama" value="<?= $gambar->tanggal_lahir ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="foto_ktp">Jenis Kelamin<em style="color:red">*</em> <?php echo form_error('jenis_kelamin') ?></label>
                                <br>
                                <input type="radio" required class="form" name="jenis_kelamin" id="jk" placeholder="No. Telp" value="Laki-Laki" <?= $gambar->jenis_kelamin == "Laki-Laki" ? "checked" : "" ?>>
                                <label for="">Laki-Laki </label>
                                <input type="radio" required class="form" name="jenis_kelamin" id="jk" placeholder="No. Telp" value="Perempuan" <?= $gambar->jenis_kelamin == "Perempuan" ? "checked" : "" ?>>
                                <label for="">Perempuan </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Alamat<em style="color:red">*</em> <?php echo form_error('alamat') ?></label>
                                <textarea name="alamat" id="alamat" class="form-control" cols="10" placeholder="Alamat" rows="3"><?= $gambar->alamat ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="foto_ktp">No. Telp<em style="color:red">*</em> <?php echo form_error('no_telp') ?></label>
                                <input type="text" required class="form-control tanya" name="no_telp" id="no_telp" placeholder="No. Telp">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="chek" id="check">
                                <label for="">Saya telah mengisi seluruh data</label>
                            </td>
                        </tr>
                        <input type="hidden" name="id" id="id" value="<?=$gambar->id?>">
                        <tr>
                            <td>
                                <button type="submit" id="btnSimpanData" class="btn btn-flat btn-primary mt-2"></span> Simpan</button>
                            </td>
                        </tr>

                </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        if ($('#check').is(":checked")) {
            $('#btnSimpanData').attr('disabled', false);
        } else {
            $('#btnSimpanData').attr('disabled', true);
        }
        $('#check').on('change', function() {
            if ($(this).is(":checked")) {
                $('#btnSimpanData').attr('disabled', false);
            } else {
                $('#btnSimpanData').attr('disabled', true);
            }
        })
    });
</script>