
    <div class="modal fade" id="exampleModalRegister" tabindex="-1" aria-labelledby="exampleModalRegister" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?php echo base_url('uploads/logo/LOGO.png') ?>" width="10%" alt="">
                    <h5 class="modal-title" id="exampleModalLabel">Mendaftar Akun baru</h5>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table style="vertical-align: top;" width="100%">
                        <form method="POST" action="<?= base_url('home/register_action') ?>" enctype="multipart/form-data" class="needs-validation" novalidate="">
                            <form accept-charset="UTF-8" role="form" class="form-signin">
                                <tr>
                                    <td>
                                    <label for="foto_ktp">Nama Lengkap</label>
                                        <input type="text" required class="form-control tanya" name="namas" id="namas" placeholder="Nama"></td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="foto_ktp">Tempat Lahir</label>
                                        <input type="text" required class="form-control tanya" name="namas" id="namas" placeholder="Nama"></td>
                                </tr>
                                <tr>
                                    <td>
                                    <label for="foto_ktp">Tanggal Lahir</label>
                                        <input type="date" required class="form-control tanya" name="namas" id="namas" placeholder="Nama"></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="foto_ktp">Email</label>
                                        <input type="text" required class="form-control tanya" name="emails" id="emails" placeholder="Email">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="foto_ktp">No. Telp</label>
                                        <input type="text" required class="form-control tanya" name="no_telp" id="no_telp" placeholder="No. Telp">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="foto_ktp">Password</label>
                                        <input type="password" required class="form-control tanya" name="passwords" id="passwords" placeholder="Password">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="foto_ktp">Foto KTP</label>
                                        <input type="file" required class="tanya" name="foto_ktp" id="foto_ktp" placeholder="KTP">

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-flat btn-primary mt-2"></span> Register</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Sudah Punya Akun? <a href="#" data-toggle="modal" data-target="#exampleModalLogin" data-dismiss="modal" style="text-decoration: none;color:red">Login Disini.</a>
                                    </td>
                                </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
