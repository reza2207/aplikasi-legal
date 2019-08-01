  
  <div class="modal-content ">
    <?php $attr = array('id'=>'form_ubah');?>
    <?= form_open('pks/submit_edit',$attr);?>
      <div class="col s12 l12">
        <div class="row">
          <div class="progress">
            <div class="indeterminate"></div>
          </div>
          <div class="input-field col l3 s3">
            <input id="id_pks" type="text" value="<?= $id;?>" readonly name="id">
            <label class="active">PKS ID</label>
          </div>

          <div class="input-field col l3 s3">
            <select id="id_vendorupdate" type="text" style="width: 100%" required name="idvendor">
              <option value="<?= $row->vendor_id;?>"><?= $row->nama_vendor;?></option>

              <?php foreach($vendor->result() as $v){?>
                <option value="<?= $v->vendor_id;?>"><?= $v->nama_vendor;?></option>
              <?php }?>
            </select>
          </div>
          <div class="input-field col s12 l3">
            <input id="no_pks" type="text" class="validate" data-length="200" max-length="200" value="<?= $row->no_pks;?>" name="nopks">
            <label class="active">No. PKS</label>
          </div>
          <div class="input-field col s12 l3">
            <input id="tgl_pks" type="text" class="validate datepicker" value="<?= $row->tgl_pks;?>" name="tglpks">
            <label class="active">Tgl. PKS</label>
          </div>
          <div class="input-field col s12 l6">
            <input id="jenis_kerjasama" type="text" class="validate"  data-length="50" maxlength="50" value="<?= $row->jenis_kerjasama;?>" name="jenis">
            <label class="active">Jenis Kerja Sama</label>
          </div>
          
          <div class="input-field col s12 l3">
            <input id="start_date" type="text" class="validate datepicker" value="<?= $row->start_date;?>" name="start">
            <label class="active">Start Date</label>
          </div>
          <div class="input-field col s12 l3">
            <input id="end_date" type="text" class="validate datepicker" value="<?= $row->end_date;?>" name="end">
            <label class="active">End Date</label>
          </div>
          <div class="input-field col s12 l6">
            <input id="nilai_kerjasama" type="number" class="validate" value="<?= $row->nilai_kerjasama;?>" name="nilai">
            <label class="active">Nilai Kerja Sama</label>
          </div>
          <div class="input-field col s12 l6">
            <input id="unit" type="text" class="validate" value="<?= $row->unit;?>" name="unit">
            <label class="active">Unit</label>
          </div>
        </div>
      </div>
    <?= form_close();?>
  </div>
  <div class="modal-footer blue lighten-4">
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
        $.ajax({
          type: 'POST',
          url: '<?= site_url()."/pks/submit_modal_edit";?>',
          data: $('#form_ubah').serialize(),
          success: function(response){
            console.log(response);
            var data = JSON.parse(response);
            swal({
              type : data.status,
              title: data.pesan
            }).then(function(){
              javascript:window.location = "<?= base_url('pks');?>";
            })
          }
        })
        
      })
    })
  })
</script>