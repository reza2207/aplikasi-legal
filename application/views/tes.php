<link href="<?= base_url().'assets/font-awesome-4.7.0/css/font-awesome.css';?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url().'assets/datatables/DataTables-1.10.13/css/jquery.dataTables.min.css';?>"/>
<link type="text/css" rel="stylesheet" href="<?= base_url().'assets/materialize/css/materialize.min.css';?>"  media="screen,projection"/>

<div class="row">

	<div class="col push-l1 l11">
		<button id="reload">refresh</button>
		<table id="table" class="table display">
			<thead>
				<tr>
					<th>No</th>
					<th>IdTes</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>





<script src="<?= base_url().'assets/js/jquery.min.js';?>"></script>
<script src="<?= base_url().'assets/materialize/js/materialize.min.js';?>"></script>	
<script src="<?= base_url().'assets/datatables/jquery.dataTables.min.js';?>"></script>

<script>
	var table;
	$(document).ready(function(){
	//alert('hehe');
		var table = $('#table').DataTable({
			"lengthMenu": [[5,10,25, 50, -1],[5,10,25,50, "All"]],
			"stateSave":true,
			"processing" : true,
			"serverSide": true,
			"order": [],
			"ajax":{
				"url": "<?= site_url('tes/get_data_tes');?>",
				"type": "POST",

			},
			"processing": true,
			"language":{
				"processing": "<div class='warning-alert'><i class='fa fa-circle-o-notch fa-spin'></i> Please wait........"
			},
			"columnDefs": [
			{
				"targets":-1,"data":null,"orderable":false,"width":"100px","defaultContent":"<button class='edit'>Edit</button><button class='hapus'>Hapus</button>",
			},
			{
				"targets":0,
				"orderable":false,
				"width":"100px",
			},
			],
		})
		$('#table_filter input ').attr('placeholder', 'Search here...');
		//$('#table_filter label').hide();
		var html = "<div class='input-field'>"+
		"<input type='search' class='validate' aria-controls='table' id='searchnew'>"+
		"<label class='active'>Search</label></div>";
		$('#table_filter label').html(html)

		
		$('#searchnew').on('keyup change', function(){
				table
					.search(this.value)
					.draw();
			
		})
		$('#reload').on('click', function(){ //reload
			$('#table').DataTable().ajax.reload();
		})
		    /*    $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );*/
        $('.select-wrapper').css('width','30px');
		$("[name='table_length']").formSelect();

		$('#table tbody').on('click','.edit', function(){
			var data = table.row($(this).parents('tr')).data();
			alert('edit');
			//console.log(data[4]);
			//console.log(data('name', 'value'));
		})
		$('#table tbody').on('click','.hapus', function(){
			var data = table.row($(this).parents('tr')).data();
			if(confirm('hapus '+data[4]+' ?')){
			
				alert('ok');
			}
			//console.log(data[4]);
			//console.log(data('name', 'value'));
		})
	
	})

</script>