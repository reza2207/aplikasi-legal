<style>

.stat-0001{
  background-color: red;color:white;
}
.stat-0001 :hover{
  color:yellow;
}

/*.first{
  padding-top: 70px;
}*/
</style>
<div class="row first">

  <div class="col push-l3 l5" >

    <button class="waves-effect waves-light btn btn-small" id="adddata"><i class="fa fa-plus"></i> data</button>
    <button class="waves-effect waves-light btn btn-small" id="btnsearchdata"><i class="fa fa-search"></i> Search</button>

  </div>
  <div class="col l2 pull-2 s12">
    <input type="text" placeholder="search" id="searchdata">

  </div>

    
    <?= !isset($_SESSION['pesan']) ? "" : $_SESSION['pesan'];?>
    <div class="col push-l3 l9 s12" >
      <table class="highlight responsive-table" id="list_tdr" style="font-size:10px;width:100%">
        <thead class="red accent-1">
          <tr>
            <th>Id. PPKS</th>
            <th>Id. Vendor</th>
            <th>Nama Vendor</th>      
            <th>Nomor PKS</th>
            <th>Tanggal PKS</th>
            <th>Jenis Kerjasama</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Nilai Kerja Sama</th>
            <th>Unit</th>
            <th>Kode Status</th>
            <?php if($role == 'superuser'){;?>
            <th>Action</th>
            <?php }; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data->result() as $row) {?>
          <tr id="row-<?= $row->vendor_id;?>" class="stat-<?= kode_status($row->start_date, $row->end_date);?>">
            <td><?= $row->ppks_id;?></td>
            <td><?= $row->vendor_id;?></td>
            <td><?= $row->nama_vendor;?></td>      
            <td><?= $row->no_pks;?></td>
            <td><?= $row->tgl_pks;?></td>
            <td><?= $row->jenis_kerjasama;?></td>
            <td><?= $row->start_date;?></td>
            <td><?= $row->end_date;?></td>
            <td><?= titik($row->nilai_kerjasama);?></td>
            <td><?= $row->unit;?></td>
            <td><?= kode_status($row->start_date, $row->end_date);?></td>
            <?php if($role == 'superuser'){;?>
            <td><button class="btn waves-effect waves-light orange darken-2 btn-small btn-update" data-id="<?= $row->ppks_id;?>" ><i class="fa fa-pencil"></i></button><button data-id="<?= $row->ppks_id;?>" class="btn waves-effect waves-light red accent-4 btn-small delete-data" ><i class="fa fa-trash"></i></button></td>
            <?php }; ?>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <?php echo $pagination; ?>  
    
  </div>

<!-- Modal Structure add data-->
  <div id="modaladddata" class="modal modal-fixed-footer">
    
    <div class="modal-content ">
      <?= form_open();?>
        <div class="col s12 l12">
          <div class="row">
            <div class="progress">
              <div class="indeterminate"></div>
            </div>
            <div class="input-field col l3 s3">
              <input id="id_pks" type="text" value="<?= $id;?>" readonly>
              <label class="active">PKS ID</label>
            </div>
            <div class="input-field col l3 s3">
              <select id="id_vendor" type="text" style="width: 100%" required="required" data-allow-clear="true">
                <option value="">Pilih Vendor</option>
                <?php foreach($vendor->result() as $v){?>
                  <option value="<?= $v->vendor_id;?>"><?= $v->nama_vendor;?></option>
                <?php }?>
              </select>
            </div>
            <div class="input-field col s12 l3">
              <input id="no_pks" type="text" class="validate" data-length="200" max-length="200">
              <label class="active">No. PKS</label>
            </div>
            <div class="input-field col s12 l3">
              <input id="tgl_pks" type="text" class="validate datepicker">
              <label class="active">Tgl. PKS</label>
            </div>
            <div class="input-field col s12 l6">
              <input id="jenis_kerjasama" type="text" class="validate"  data-length="50" maxlength="50">
              <label class="active">Jenis Kerja Sama</label>
            </div>
            
            <div class="input-field col s12 l3">
              <input id="start_date" type="text" class="validate datepicker">
              <label class="active">Start Date</label>
            </div>
            <div class="input-field col s12 l3">
              <input id="end_date" type="text" class="validate datepicker">
              <label class="active">End Date</label>
            </div>
            <div class="input-field col s12 l6">
              <input id="nilai_kerjasama" type="number" class="validate">
              <label class="active">Nilai Kerja Sama</label>
            </div>
            <div class="input-field col s12 l6">
              <input id="unit" type="text" class="validate">
              <label class="active">Unit</label>
            </div>
          </div>
        </div>
      <?= form_close();?>
    </div>
    <div class="modal-footer blue lighten-4">
      <button class="modal-close waves-effect waves-light btn-flat">CLOSE</button>
      <button class="modal-close waves-effect waves-yellow btn-flat" type="cancel">CANCEL</button>
      <button id="savebutton" class="waves-effect waves-green btn"><i class="fa fa-save"></i></button>
    </div>
  </div>
</div>


</html>

  <!-- end modal add data-->
<!-- Modal Structure add data-->
  <div id="modalupdatedata" class="modal modal-fixed-footer">

  </div>
  <!--end modal -->
<script>
  $(document).ready(function(){
    $("#nama_vendor,  #id_vendorupdate").select2({placeholder: 'Select an option'});
    $('input#alamat, textarea#textarea2').characterCounter();
    $('.datepicker').datepicker({
      container: 'body',
      format: 'yyyy-mm-dd',
      autoClose: 'true'
    });
    $("#id_vendor").select2({placeholder: 'Select an option'});
    $('.modal').modal({
      dismissible : false
    });
    $('#adddata').on('click', function(){
      $('#modaladddata').modal('open');

      $('.progress').hide();
    });
    $('#searchdata').hide();
    $
    $('#btnsearchdata').on('click', function(){
      
      $('#searchdata').toggle('slow');
      $('#searchdata').keypress(function(e){
        if(e.which == 13){
          var value = this.value;
          $.ajax({
            type: 'POST',
            url: "<?= base_url().'pks/cari_pks';?>",
            data: {value: value},
            success: function(response){
              //console.log(response);
              window.location = '<?= base_url()."pks/q/";?>'+value;
            }
          })
        }
      })

    })
    
    $('#savebutton').on('click', function(){

      var id = $('#id_pks').val();
      var idvendor = $('#id_vendor').val();
      var nopks = $('#no_pks').val();
      var tglpks = $('#tgl_pks').val();
      var jenis = $('#jenis_kerjasama').val();
      var start = $('#start_date').val();
      var end = $('#end_date').val();
      var nilai = $('#nilai_kerjasama').val();
      var unit = $('#unit').val();
      $('.progress').show();
      $.ajax({
        type: 'POST',
        url: '<?= site_url()."pks/submit_pks";?>',
        data: {id: id, idvendor: idvendor, nopks: nopks, tglpks: tglpks, jenis: jenis, start: start, end: end, nilai: nilai, unit: unit},
        success: function(response){
          console.log(response);
          $('.progress').hide();
          var data = JSON.parse(response);

          if(data.status == 'success'){
            swal({
              type: data.status,
              text: data.pesan,
              showConfirmButton: true,
            }).then(function(){
              swal({
                type: 'question',
                text: 'Continue adding data?',
                showConfirmButton: true,
                showCancelButton: true,
              }).then(function(){

              }, function(dismiss){
                if( dismiss=='cancel'){
                  javascript:window.location = "<?= base_url('pks');?>";
                  //$('#modaladddata').modal('close');
                }
              })
            });
            $('#id_pks').val(data.idbaru);
          }else{
            swal({
              type: data.status,
              text: data.pesan,
              showConfirmButton: true,
            }).then(function(){
              $('#modaladddata').modal('close');
            })
          }
        }, error: function(){
          $('.progress').hide();
          console.log('gagal');
        }
      });
    });
    $('.delete-data').on('click', function(){
      
      let id = $(this).attr('data-id');
      let rowid = this;
      swal({
        type: 'question',
        text: 'Are you sure to deleting this data?',
        showConfirmButton: true,
        showCancelButton: true,
      }).then(function(){
            
        $.ajax({
          type: 'POST',
          url: "<?= site_url().'pks/hapus_pks';?>",
          data: {id: id},
          success: function(response){
            var data = JSON.parse(response);
            swal({
              type: data.status,
              text: data.pesan,
              showConfirmButton: true,
            })
            $(rowid).closest('tr').remove();
          }
     
        })
      })
    })

    $('.btn-update').on('click', function(){
      $('.progress').hide();
      //get attr from table
      var id = $(this).attr('data-id');
      var currentRow=$(this).closest("tr");
      //open modal
      $('#modalupdatedata').modal('open');

      $.ajax({
        type: 'POST',
        url: "<?= base_url().'pks/modal_edit';?>",
        data: {id:id},
        success: function(response){
          $('#modalupdatedata').html(response);
        }
      })
      

      $('#updatebutton').on('click', function(){
        //set value
      var namas = $('#nm_vendorupdate').val();
      var alamats = $('#alamatupdate').val();
      var kotas = $('#kotaupdate').val();
      var zips = $('#zip_codeupdate').val();
      var phone1s = $('#phone_1update').val();
      var phone2s = $('#phone_2update').val();
      var faxs = $('#faxupdate').val();
      var emails = $('#emailupdate').val();
      var bidangs = $('#bidang_usahaupdate').val();
      var npwps = $('#npwpupdate').val();
      var keterangans = $('#keteranganupdate').val();
      
        $('.progress').show();
        $.ajax({
          type: 'POST',
          url: '<?= site_url()."vendor/update_perusahaan";?>',
          data: {id: id, nama: namas, alamat: alamats, kota: kotas, zip: zips, phone1: phone1s, phone2: phone2s, fax: faxs, email: emails, bidang: bidangs, npwp: npwps, keterangan: keterangans},
          success: function(response){
            $('.progress').hide();
            var data = JSON.parse(response);
            swal({
              type: data.type,
              text: data.message,
              showConfirmButton: true,
            }).then(function(){
              location.reload(); 
            })
          }
        })
      })
    })
   })
  
</script>