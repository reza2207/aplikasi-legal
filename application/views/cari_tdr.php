<div class="row first" style="min-height: 510px">
  <!-- <div class="col s12"> -->
  <div class="col push-l3 l5 s12" style="padding-top: 10px;padding-bottom: 10px">
    <button class="waves-effect waves-light btn btn-small" id="adddata"><i class="fa fa-plus"></i> data</button>
    <button class="waves-effect waves-light btn btn-small" id="btnsearchdata"><i class="fa fa-search"></i> Search</button>
    <!-- <button class="waves-effect waves-light btn btn-small" id="btnsortdata"><i class="fa fa-sort"></i> Sort By</button> -->
    
  </div>
  

  <div class="col l2 pull-1 s12">
    <input type="text" placeholder="search" id="searchdata">
    
  </div>
  <div class="col push-l3 l9 s12">
    <span>Searching result '<?= $value;?>' is <?= $jml;?> record (s) ....</span>
  </div>
  <?= !isset($_SESSION['pesan']) ? "" : $_SESSION['pesan'];?>
  <div class="col push-l3 l9 s12">
    <table class="highlight" id="list_tdr" style="font-size:10px;width:100%">
      <thead class="red accent-1">
        <tr>
          <th>Id. TDR</th>
          <th>Id. Vendor</th>
          <th>Nama Vendor</th>      
          <th>Nomor TDR</th>
          <th>Tanggal TDR</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Keterangan</th>
          
          <?php if($role == 'superuser'){;?>
          <th>Action</th>
          <?php }; ?>
        </tr>
      </thead>
      <?php if($jml>0){?>
      <tbody>
        <?php foreach ($data->result() as $row) {?>
        <tr id="row-<?= $row->vendor_id;?>">
          <td><?= $row->tdr_id;?></td>
          <td><?= $row->vendor_id;?></td>
          <td><?= $row->nama_vendor;?></td>      
          <td><?= $row->no_tdr;?></td>
          <td><?= $row->tgl_tdr;?></td>
          <td><?= $row->start_date;?></td>
          <td><?= $row->end_date;?></td>
          <td><?= $row->keterangan;?></td>
          <?php if($role == 'superuser'){;?>
          <td><button class="btn waves-effect waves-light orange darken-2 btn-small btn-update" data-id="<?= $row->vendor_id;?>" ><i class="fa fa-pencil"></i></button><button data-id="<?= $row->tdr_id;?>" class="btn waves-effect waves-light red accent-4 btn-small delete-data" ><i class="fa fa-trash"></i></button></td>
          <?php }; ?>
        </tr>
        <?php }?>
      </tbody>
    <?php }?>
    </table>
  </div>

</div>

<!-- Modal Structure add data-->
  <div id="modaladddata" class="modal modal-fixed-footer">
    
    <div class="modal-content">
      <?= form_open();?>
        <div class="col s12 l12">
          <div class="row">
            <div class="progress">
              <div class="indeterminate"></div>
            </div>
            <div class="input-field col s12 l3">
              <input id="id_tdr" type="text" value="<?= $id;?>" readonly>
              <label class="active">Id TDR</label>
            </div>
            <div class="input-field col s12 l3">
              <!-- <label class="active">Id Vendor</label> -->
              <select id="nama_vendor" type="text" style="width: 100%" required>
                <option value="">Pilih Vendor</option>
                <?php foreach($vendor->result() as $v){?>
                  <option value="<?= $v->vendor_id;?>"><?= $v->nama_vendor;?></option>
                <?php }?>
              </select>
            </div>
            <div class="input-field col s12 l6">
              <input id="id_vendor" type="text" readonly> 
            </div>
            <div class="input-field col s12 l3">
              <input id="no_tdr" type="text" class="validate" data-length="20" max-length="20">
              <label class="active">No. TDR</label>
            </div>  
            <div class="input-field col s12 l3">
              <input id="tgl_tdr" type="text" class="datepicker">
              <label class="active">Tgl. TDR</label>
            </div>
            <div class="input-field col s12 l3">
              <input id="start_date" type="text" class="datepicker">
              <label class="active">Start Date</label>
            </div>
            <div class="input-field col s12 l3">
              <input id="end_date" type="text" class="datepicker">
              <label class="active">End Date</label>
            </div>
            <div class="input-field col s12 l12">
              <input id="keterangan" type="text" class="validate">
              <label class="active">Keterangan</label>
            </div>
            
          </div>
        </div>
      <?= form_close();?>
    </div>
    <div class="modal-footer">
      <button class="modal-close waves-effect waves-light btn-flat">CLOSE</button>
      <button class="modal-close waves-effect waves-yellow btn-flat" type="cancel">CANCEL</button>
      <button id="savebutton" class="waves-effect waves-green btn"><i class="fa fa-save"></i></button>
    </div>
  </div>
  <!-- end modal add data-->
<!-- Modal Structure add data-->
  <div id="modalupdatedata" class="modal modal-fixed-footer">
    
  </div>
  <!--end -->
<script>
  $(document).ready(function(){

    //$(' #id_vendorupdate').formSelect();
    $('.modal').modal();
    $("#nama_vendor,  #id_vendorupdate").select2();
    //this are my init
    $('.datepicker').datepicker({
      container: 'body',
      format: 'yyyy-mm-dd',
      autoClose: 'true'
    });
    $('.datepickers').datepicker({
      container: 'body',
      format: 'yyyy-mm-dd',
      autoClose: 'true',
      setDefaultDate: 'true',
      //disableWeekends: 'true',
      })
    $('input#alamat, textarea#textarea2').characterCounter();
    
    $('.modal').modal({
      dismissible : false
    });
    $('#adddata').on('click', function(){
      $('#modaladddata').modal('open');
      $('.progress').hide();
    });
    $('#searchdata').hide();
    
    $('#btnsearchdata').on('click', function(){
      
      $('#searchdata').toggle();
    })
    $('#sortdata').hide();

    $('#nama_vendor').on('change', function(){
      var value = $('#nama_vendor').val();
      $('#id_vendor').val(value);
    })
    $('#savebutton').on('click', function(){

      
      var id_tdr = $('#id_tdr').val();
      var id_vendor = $('#nama_vendor').val();
      var no_tdr = $('#no_tdr').val();
      var tgl_tdr = $('#tgl_tdr').val();
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      var keterangan= $('#keterangan').val();
      $('.progress').show();
      $.ajax({
        type: 'POST',
        url: '<?= site_url()."/tdr/submit_tdr";?>',
        data: {id_tdr: id_tdr, id_vendor: id_vendor, no_tdr: no_tdr, tgl_tdr: tgl_tdr, start_date: start_date, end_date: end_date, keterangan: keterangan},
        success: function(response){
          $('.progress').hide();
          console.log(response);
          var data = JSON.parse(response);
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
              $('#id_tdr').val(data.idbaru);
            }, function(dismiss){
              if( dismiss=='cancel'){
                javascript:window.location = "<?= base_url('tdr');?>";
              }
            }) 
          });
          
        }, error: function(response){
          $('.progress').hide();

          console.log('gagal');
        }
      });
    });
    $('.delete-data').on('click', function(){
      var id = $(this).attr('data-id');
      let rowid = this;
      
      swal({
        type: 'warning',
        text: 'Are you sure to deleting this data?',
        showConfirmButton: true,
        showCancelButton: true,
      }).then(function(){
            
        $.ajax({
          type: 'POST',
          url: "<?= site_url().'/tdr/hapus_tdr/';?>"+id,
          data: {id: id},
          success: function(response){
            $(rowid).closest('tr').remove();
            swal({
              type: 'success',
              text: 'Deleting Success',
              showConfirmButton: true,
            })
          }
     
        })
      })
    })

    $('.btn-update').on('click', function(){
      $('.progress').hide();
      //get attr from table
      
      var currentRow=$(this).closest("tr");
      var id = currentRow.find("td:eq(0)").text();
      var idvendor = currentRow.find("td:eq(1)").text();
      var namavendor = currentRow.find("td:eq(2)").text();
      var notdr = currentRow.find("td:eq(3)").text();
      var tgltdr = currentRow.find("td:eq(4)").text();
      var strtdr = currentRow.find("td:eq(5)").text();
      var endtdr = currentRow.find("td:eq(6)").text();
      var ket = currentRow.find("td:eq(7)").text();
      
      //open modal
      $('#modalupdatedata').modal('open');
      $.ajax({
        type: 'POST',
        url: "<?= site_url().'tdr/modal_edit';?>",
        data: {id: id, idvendor: idvendor, namavendor: namavendor},
        success: function(response){

          $('#modalupdatedata').html(response);
        },
        error: function(response){
          console.log(response);
        }


      });
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
    $('#searchdata').keypress(function(e){
        
        if (e.which == 13) {
          var value = $('#searchdata').val();
          
          $.ajax({
            type: 'POST',
            url: '<?= site_url()."tdr/cari_tdr";?>',
            data: {value: value},
            success: function(response){
              //console.log(response);
              window.location = '<?= base_url()."tdr/q/";?>'+value;

            }
          })
        }
      })
   })
  
</script>