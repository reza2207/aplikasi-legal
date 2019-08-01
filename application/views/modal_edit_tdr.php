<div class="modal-header">
      <div class="center">Update Data</div>
</div>
<div class="modal-content">
  <?= form_open();?>
    <div class="col s12 l12">
      <div class="row">
        <div class="progress">
          <div class="indeterminate"></div>
        </div>
         <div class="input-field col s12 l3">
          <input id="id_tdrupdate" type="text" value="<?= $id;?>" readonly>
          <label class="active">Id TDR</label>
        </div>
        <div class="input-field col s12 l3">
          <!-- <label class="active">Nama Vendor</label> -->
          <select id="id_vendorupdate" type="text" style="width: 100%" required>
              <option value="<?= $idvendor;?>"><?= $namavendor;?></option>
            <?php foreach($vendor->result() as $v){?>

              <option value="<?= $v->vendor_id;?>"><?= $v->nama_vendor;?></option>
            <?php }?>

          </select>
        </div>

        <div class="input-field col s12 l6">
          <input id="nama_vendorupdate" type="text" readonly value="<?= $row->vendor_id;?>">
          <label class="active">Id TDR</label>
        </div>
        <div class="input-field col s12 l3">
          <input id="no_tdrupdate" type="text" class="validate" data-length="20" max-length="20" placeholder="No. TDR" value="<?= $row->no_tdr;?>">
          <label class="active">No. TDR</label>
        </div>  
        <div class="input-field col s12 l3">
          <input id="tgl_tdrupdate" type="text" placeholder="Tgl. TDR" class="datepicker" value="<?= $row->tgl_tdr;?>">
          <label class="active">Tgl. TDR</label>
        </div>
        <div class="input-field col s12 l3">
          <input id="start_dateupdate" type="text" placeholder="Start Date" class="datepicker" value="<?= $row->start_date;?>">
          <label class="active">Start Date</label>
        </div>
        <div class="input-field col s12 l3">
          <input id="end_dateupdate" type="text" placeholder="End Date" class="datepicker" value="<?= $row->end_date;?>">
          <label class="active">End Date</label>
        </div>
        <div class="input-field col s12 l12">
          <input id="keteranganupdate" type="text" class="validate" placeholder="Keterangan" value="<?= $row->keterangan;?>">
          <label class="active">Keterangan</label>
      </div>
    </div>
    <?= form_close();?>
    </div>
  </div>
  <div class="modal-footer">
    <button class="modal-close waves-effect waves-light btn-flat">CLOSE</button>
    <button class="modal-close waves-effect waves-yellow btn-flat" type="cancel">CANCEL</button>
    <button id="updatebutton" class="waves-effect waves-green btn"><i class="fa fa-save"></i></button>
  </div>

<script>
  $(document).ready(function(){
    //$(' #id_vendorupdate').formSelect();
    $('.progress').hide();
    //$(' #id_vendorupdate').formSelect();
    $("#nama_vendor,  #id_vendorupdate").select2();
    $('.datepicker').datepicker({
      container: 'body',
      format: 'yyyy-mm-dd',
      autoClose: 'true'
    });
    $('#id_vendorupdate').on('change', function(){
      var value = $('#id_vendorupdate').val();
      $('#nama_vendorupdate').val(value);
    })

    $('#updatebutton').on('click', function(){
      swal({
        type : 'warning',
        title: 'Are you sure to updating this data?',
        showCancelButton: true,
      }).then(function(){
        var id_tdrupdate = $('#id_tdrupdate').val();
        var id_vendorupdate = $('#id_vendorupdate').val();
        var no_tdrupdate = $('#no_tdrupdate').val();
        var tgl_tdrupdate = $('#tgl_tdrupdate').val();
        var start_dateupdate = $('#start_dateupdate').val();
        var end_dateupdate = $('#end_dateupdate').val();
        var keteranganupdate = $('#keteranganupdate').val();

        $.ajax({
          type: 'POST',
          url: '<?= site_url()."/tdr/submit_modal_edit";?>',
          data: {id_tdr: id_tdrupdate, id_vendor: id_vendorupdate, no_tdr: no_tdrupdate, tgl_tdr: tgl_tdrupdate, start_date: start_dateupdate, end_date: end_dateupdate, keterangan: keteranganupdate},
          success: function(response){
            var data = JSON.parse(response);
            swal({
              type : data.status,
              title: data.pesan
            }).then(function(){
              location.reload();
            })
          }
        })
        
      })
    })
  })
</script>