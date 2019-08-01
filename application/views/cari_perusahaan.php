<div class="row first" style="min-height: 510px">
  <!-- <div class="col s12"> -->
  <div class="col push-l3 l9 s12" style="padding-top: 10px;padding-bottom: 10px">
    <button class="waves-effect waves-light btn btn-small" id="adddata"><i class="fa fa-plus"></i> data</button>
    <button class="waves-effect waves-light btn btn-small" id="btnsearchdata"><i class="fa fa-search"></i> Search</button>
    
  </div>
  <div class="col push-l3 l4 pull-5 s12">
    <input type="text" placeholder="search" id="searchdata">
    <span>Searching result '<?= $value;?>' is <?= $jml;?> record (s) ....</span>
  </div>
  
  <?= !isset($_SESSION['pesan']) ? "" : $_SESSION['pesan'];?>
  <div class="col push-l3 l9 s12">
    <table class="highlight" id="list_tdr" style="font-size:10px;width:100%">
      <thead class="red accent-1">
        <tr>
          <th>Vendor Id</th>
          <th>Nama Vendor</th>
          <th>Alamat</th>      
          <th>Kota</th>
          <th>Kode Pos</th>
          <th>Telepon-1</th>
          <th>Telepon-2</th>
          <th>Nomor Fax</th>
          <th>Alamat E-mail</th>
          <th>Bidang Usaha</th>
          <th>Nomor Pokok Wajib Pajak</th>
          <th>Keterangan</th>
          <th>Unit</th>
          <?php if($role == 'superuser'){;?>
          <th>Action</th>
          <?php }; ?>
        </tr>
      </thead>
      <tbody>
        <?php if($jml > 0){?>
        <?php foreach ($data->result() as $row) {?>
        <tr id="row-<?= $row->vendor_id;?>">
          <td class="row-vendor_id"><?= $row->vendor_id;?></td>
          <td class="row-nama"><?= $row->nama_vendor;?></td>
          <td class="row-alamat"><?= $row->alamat;?></td>      
          <td class="row-kota"><?= $row->kota;?></td>
          <td class="row-pos"><?= $row->kode_pos;?></td>
          <td class="row-tel1"><?= $row->telp_1;?></td>
          <td class="row-tel2"><?= $row->telp_2;?></td>
          <td class="row-fax"><?= $row->fax;?></td>
          <td class="row-email"><?= $row->email;?></td>
          <td class="row-bidang"><?= $row->bidang_usaha;?></td>
          <td class="row-npwp"><?= $row->npwp;?></td>
          <td class="row-keterangan"><?= $row->keterangan;?></td>
          <td class="row-unit"><?= $row->unit;?></td>
          <?php if($role == 'superuser'){;?>
          <td><button class="btn waves-effect waves-light orange darken-2 btn-small btn-update" data-id="<?= $row->vendor_id;?>" ><i class="fa fa-pencil"></i></button><button data-id="<?= $row->vendor_id;?>" class="btn waves-effect waves-light red accent-4 btn-small delete-data" ><i class="fa fa-trash"></i></button></td>
          <?php }; ?>
        </tr>
        <?php }?>
        <?php }?>
      </tbody>
    </table>
  </div>
  

</div>
<hr>
<!-- Modal Structure add data-->
  <div id="modaladddata" class="modal modal-fixed-footer">
    
    <div class="modal-content">
      <?= form_open();?>
        <div class="col s12 l12">
          <div class="row">
            <div class="progress">
              <div class="indeterminate"></div>
            </div>
            <div class="input-field col s12 l6">
              <input id="id_vendor" type="text" value="<?= $id;?>" readonly>
              <label class="active">Id Vendor</label>
            </div>
            <div class="input-field col s12 l6">
              <input id="nm_vendor" type="text" class="validate">
              <label class="active">Nama Vendor</label>
            </div>
            <div class="input-field col s12 l12">
              <input id="alamat" type="text" class="validate" data-length="200" max-length="200">
              <label class="active">Alamat</label>
            </div>  
            <div class="input-field col s12 l12">
              <input id="kota" type="text" class="validate">
              <label class="active">Kota</label>
            </div>
            <div class="input-field col s12 l4">
              <input id="zip_code" type="text" class="validate"  data-length="5" maxlength="5">
              <label class="active">Zip Code</label>
            </div>
            <div class="input-field col s12 l4">
              <input id="phone_1" type="text" class="validate">
              <label class="active">Phone 1</label>
            </div>
            <div class="input-field col s12 l4">
              <input id="phone_2" type="text" class="validate">
              <label class="active">Phone 2</label>
            </div>
            <div class="input-field col s12 l6">
              <input id="fax" type="text" class="validate">
              <label class="active">Fax</label>
            </div>
            <div class="input-field col s12 l6">
              <input id="email" type="email" class="validate">
              <label class="active">Email</label>
              <span class="helper-text" data-error="format email salah" data-success="ok"></span>
            </div>
            <div class="input-field col s12 l4">
              <input id="bidang_usaha" type="text" class="validate" maxlength="4">
              <label class="active">Bidang Usaha</label>
            </div>
            <div class="input-field col s12 l8">
              <input id="NPWP" type="text" class="validate">
              <label class="active">NPWP</label>
            </div>
            <div class="input-field col s12 l8">
              <input id="keterangan" type="text" class="validate">
              <label class="active">Keterangan</label>
            </div>
            <div class="input-field col s12 l4">
              <input id="unit" type="text" class="validate" maxlength="15">
              <label class="active">Unit</label>
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
    <div class="modal-header">
      <div class="center"><strong>Update Data</strong></div>
    </div>
    <div class="modal-content">
      <?= form_open();?>
        <div class="col s12 l12">
          <div class="row">
            <div class="progress">
              <div class="indeterminate"></div>
            </div>
            <div class="input-field col s12 l6">
              <input id="id_vendorupdate" type="text" value="" readonly>
            </div>
            <div class="input-field col s12 l6">
              <input id="nm_vendorupdate" type="text" class="validate" placeholder="Nama Vendor">
            </div>
            <div class="input-field col s12 l12">
              <input id="alamatupdate" type="text" class="validate" data-length="200" max-length="200" placeholder="Alamat">
            </div>  
            <div class="input-field col s12 l12">
              <input id="kotaupdate" type="text" class="validate" placeholder="Kota">
            </div>
            <div class="input-field col s12 l4">
              <input id="zip_codeupdate" type="text" class="validate"  data-length="5" maxlength="5" placeholder="Zip Code">
            </div>
            <div class="input-field col s12 l4">
              <input id="phone_1update" type="text" class="validate" placeholder="Phone 1">
            </div>
            <div class="input-field col s12 l4">
              <input id="phone_2update" type="text" class="validate" placeholder="Phone 2">
            </div>
            <div class="input-field col s12 l6">
              <input id="faxupdate" type="text" class="validate" placeholder="Fax">
            </div>
            <div class="input-field col s12 l6">
              <input id="emailupdate" type="email" class="validate" placeholder="Email">
              <span class="helper-text" data-error="format email salah" data-success="ok"></span>
            </div>
            <div class="input-field col s12 l4">
              <input id="bidang_usahaupdate" type="text" class="validate" maxlength="4" placeholder="Bidang Usaha">
            </div>
            <div class="input-field col s12 l8">
              <input id="npwpupdate" type="text" class="validate" placeholder="NPWP">
            </div>
            <div class="input-field col s12 l8">
              <input id="keteranganupdate" type="text" class="validate" placeholder="Keterangan">
            </div>
            <div class="input-field col s12 l4">
              <input id="unitupdate" type="text" class="validate" placeholder="Unit">
            </div>
          </div>
        </div>
      <?= form_close();?>
    </div>
    <div class="modal-footer">
      <button class="modal-close waves-effect waves-light btn-flat">CLOSE</button>
      <button class="modal-close waves-effect waves-yellow btn-flat" type="cancel">CANCEL</button>
      <button id="updatebutton" class="waves-effect waves-green btn"><i class="fa fa-save"></i></button>
    </div>
  </div>
  <!--end -->
<script>
  $(document).ready(function(){

    $('input#alamat, textarea#textarea2').characterCounter();
    
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
      
      $('#searchdata').toggle();
    })
    $('#sortdata').hide();
    $('#btnsortdata').on('click', function(){
      $('#sortdata').formSelect();
      //$('#sortdata').toggle();

      $('#sortdata').on('change', function(){
        var sb = $('#sortdata').val();
        window.location.href = '<?= base_url()."vendor/perusahaan/page/sort_by/";?>'+sb;
      })
    })
    $('#savebutton').on('click', function(){

      var id = $('#id_vendor').val();
      var nama = $('#nm_vendor').val();
      var alamat = $('#alamat').val();
      var kota = $('#kota').val();
      var zip = $('#zip_code').val();
      var phone1 = $('#phone_1').val();
      var phone2 = $('#phone_2').val();
      var fax = $('#fax').val();
      var email = $('#email').val();
      var bidang = $('#bidang_usaha').val();
      var npwp = $('#NPWP').val();
      var keterangan = $('#keterangan').val();
      var unit = $('#unit').val();
      $('.progress').show();
      $.ajax({
        type: 'POST',
        url: '<?= site_url()."vendor/submit_perusahaan";?>',
        data: {id: id, nama: nama, alamat: alamat, kota: kota, zip: zip, phone1: phone1, phone2: phone2, fax: fax, email: email, bidang: bidang, npwp: npwp, keterangan: keterangan, unit: unit},
        success: function(response){
          $('.progress').hide();
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

            }, function(dismiss){
              if( dismiss=='cancel'){
                $('#modaladddata').modal('close');
              }
            }) 
          });
          $('#id_vendor').val(data.idbaru);
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
          url: "<?= site_url().'vendor/perusahaan/hapus/id/';?>"+id,
          data: {id: id},
          success: function(response){
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
      var nama = currentRow.find("td:eq(1)").text();
      var alamat = currentRow.find("td:eq(2)").text();
      var kota = currentRow.find("td:eq(3)").text();
      var zip = currentRow.find("td:eq(4)").text();
      var ph1 = currentRow.find("td:eq(5)").text();
      var ph2 = currentRow.find("td:eq(6)").text();
      var fax = currentRow.find("td:eq(7)").text();
      var email = currentRow.find("td:eq(8)").text();
      var bidang = currentRow.find("td:eq(9)").text();
      var npwp = currentRow.find("td:eq(10)").text();
      var keterangan = currentRow.find("td:eq(11)").text();
      var unit = currentRow.find("td:eq(12)").text();
      //open modal
      $('#modalupdatedata').modal('open');
      $('#id_vendorupdate').val(id);
      $('#nm_vendorupdate').val(nama);
      $('#alamatupdate').val(alamat);
      $('#kotaupdate').val(kota);
      $('#zip_codeupdate').val(zip);
      $('#phone_1update').val(ph1);
      $('#phone_2update').val(ph2);
      $('#faxupdate').val(fax);
      $('#emailupdate').val(email);
      $('#bidang_usahaupdate').val(bidang);
      $('#npwpupdate').val(npwp);
      $('#keteranganupdate').val(keterangan);
      $('#unitupdate').val(unit);

      

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
      var units = $('#unitupdate').val();
      
        $('.progress').show();
        $.ajax({
          type: 'POST',
          url: '<?= site_url()."vendor/update_perusahaan";?>',
          data: {id: id, nama: namas, alamat: alamats, kota: kotas, zip: zips, phone1: phone1s, phone2: phone2s, fax: faxs, email: emails, bidang: bidangs, npwp: npwps, keterangan: keterangans, unit: units},
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
          url: '<?= site_url()."vendor/cari_perusahaan";?>',
          data: {value: value},
          success: function(response){

            window.location = '<?= base_url()."vendor/perusahaan/q/";?>'+value;

          }
        })
      }
    })
   })
  
</script>