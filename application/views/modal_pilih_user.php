<section class="contact_us">
    <div class="modal fade" id="modalPilihUser" tabindex="-1" aria-labelledby="modalPilihUser" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?php echo base_url('uploads/logo/LOGO.png') ?>" width="10%" alt="">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Pembaca</h5>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idOrder" id="idOrder">
                    <input type="hidden" name="client_id" id="client_id">
                    <div class="table-responsive">
                        <table class="data-table table hover nowrap" id="tabelUser" style="min-width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>SIP</th>
                                    <th>Nama</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <script>
                            $(document).ready(function() {
                                dataTable2 = $('#tabelUser').DataTable({
                                    "processing": true,
                                    "serverSide": true,
                                    "scrollX": false,
                                    "paging": true,
                                    "autoWidth": true,
                                    "language": {
                                        "infoFiltered": "",
                                        "searchPlaceholder":"Pencarian..",
                                        "processing": "<td style='text-align:center;width:100%;display:block;'><i class='fa fa-spinner fa-spin' style='font-size:80px'></i> </td>",
                                    },
                                    "order": [],
                                    "lengthMenu": [
                                        [5, 10, 25, 50, 75, 100],
                                        [5, 10, 25, 50, 75, 100]
                                    ],
                                    "ajax": {
                                        url: "<?php echo site_url('api/fetch_user'); ?>",
                                        type: "POST",
                                        dataSrc: "data",
                                        data: function(d) {
                                           d.id=$('#idOrder').val();
                                           d.idClient=$('#client_id').val();
                                        },
                                    },
                                    "columnDefs": [{
                                            "targets": [2],
                                            "orderable": false
                                        },
                                        {
                                            "targets": [0],
                                            "className": 'text-center'
                                        },

                                    ],
                                });
                                dataTable2.on('draw.dt', function() {
                                    var info = dataTable2.page.info();
                                    dataTable2.column(0, {
                                        search: 'applied',
                                        order: 'applied',
                                        page: 'applied'
                                    }).nodes().each(function(cell, i) {
                                        cell.innerHTML = i + 1 + info.start + ".";
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

