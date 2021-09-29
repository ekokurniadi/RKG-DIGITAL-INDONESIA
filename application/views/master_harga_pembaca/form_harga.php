<script>
	Vue.use(VueNumeric.default);
	Vue.filter('toCurrency', function(value) {
		return accounting.formatMoney(value, "", 0, ".", ",");
		return value;
	});
</script>
<div class="main-container" style="min-height:100%">
	<div class="pd-ltr-20 xs-pd-20-10">
		<div class="min-height-200px">
			<div class="page-header">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						<div class="title">
							<h4>Setting Harga Pembaca</h4>
						</div>
						<nav aria-label="breadcrumb" role="navigation">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>panel">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Setting Harga Pembaca</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>

			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Form Harga Pembaca </h4>
						<p class="mb-30"></p>
					</div>
				</div>
				<form id="form_" method="post" class="form-horizontal">

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">SIP <?php echo form_error('sip') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" readonly class="form-control" name="sip" id="sip" placeholder="SIP" value="<?php echo $sip; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-12 col-md-2 col-form-label">Nama <?php echo form_error('nama') ?></label>
						<div class="col-sm-12 col-md-10">
							<input type="text" readonly class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-12 col-md-12">
							<table class="table table-bordered">
								<tr>
									<th width="20px">No</th>
									<th>Kode</th>
									<th>Harga</th>
									<th>Action</th>
								</tr>
								<tr v-for="(data,index) of details">
									<td>{{index+1}}</td>
									<td>{{data.kode}}</td>
									<td>{{data.harga|toCurrency}}</td>
									<td align="center" v-if="mode=='update'|| mode=='create'">
										<?php if ($_SESSION['level'] != "Client") { ?>
											<button @click.prevent="delDetails(index)" type="button" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i></button>
										<?php } ?>
									</td>
								</tr>
								<tfoot v-if="mode=='update'|| mode=='create'">
									<tr>
										<th colspan="2">
											<input type="text" v-model="detail.kode" class="form-control" placeholder="Kode">
										</th>
										<th>
											<vue-numeric v-model="detail.harga" thousand-separator="." :empty-value="0" class="form-control"/>
										</th>
										<th>
											<button @click.prevent="addDetails()" type="button" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus"></i></button>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

					<div class="card-footer text-left">
						<input type="hidden" name="id" value="<?php echo $id; ?>" />
						<button type="button" id="btnSubmit" class="btn btn-primary"><span class="fa fa-edit"></span>Simpan</button>
						<a href="<?php echo site_url('master_harga') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

				</form>
			</div>
		</div>
	</div>
</div>
<?php $details = $this->db->get_where('master_harga_pembaca', array('id_pembaca' => $id))->result() ?>

<script>
	var form_ = new Vue({
		el: '#form_',
		data: {
			detail: {
				harga: '',
				kode:'',
			},
			mode: '<?= $mode ?>',
			details: <?= isset($details) ? json_encode($details) : '[]' ?>,
		},
		methods:{
			clearDetails:function(){
				this.detail={}
			},
			addDetails:function(){
				if(this.detail.harga=="" || this.detail.harga=="0" || this.detail.kode==""){
					alert("Mohon isi terlebih dahulu");
					return false;
				}
				this.details.push(this.detail);
				this.clearDetails();
			},
			delDetails:function(index){
				this.details.splice(index,1);
			}
		}
	});

	$('#btnSubmit').click(function() {
		var values = {
			id: $('#id').val(),
			details: form_.details,
		}
		var form = $('#form_').serializeArray();
		for (field of form) {
			values[field.name] = field.value
		}
		$.ajax({
			url: '<?php echo base_url('master_harga/save') ?>',
			type: 'POST',
			dataType: 'JSON',
			data: values,
			cache: false,
			beforeSend: function() {
				$('#btnSubmit').attr('disabled', true);
				$('#btnSubmit').html('<i class="fa fa-spinner fa-spin"></i> Process');
			},
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
				alert('Terjadi Kesalahan');
			}
		});
	});
</script>
