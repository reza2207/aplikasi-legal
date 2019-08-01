
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="<?= base_url().'assets/font-awesome-4.7.0/css/font-awesome.css';?>" rel="stylesheet">
      <link href="<?= base_url().'assets/css/sweetalert2.min.css';?>" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?= base_url().'assets/materialize/css/materialize.min.css';?>"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="<?= base_url().'assets/datatables/DataTables-1.10.13/css/jquery.dataTables.min.css';?>"/>
      <link href="<?= base_url().'assets/css/select2.min.css';?>" rel="stylesheet">
      <link href="<?= base_url().'assets/css/reza.css';?>" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <title><?= $title == "" ? "" : $title;?></title>
    <style>
    
    </style>
    <body class="deep-orange lighten-5">
        <div class="waiting">
          <div class="warning-alert"><i class="fa fa-circle-o-notch fa-spin"></i> Please wait........
          </div>
        </div>
        <nav class="deep-orange accent-3 header" style="">
          <div class="nav-wrapper">

            <a href="<?= site_url();?>" data-target="slide-out" class="show-on-large hide-on-med-and-down brand-logo center">System PKS</a>
            <a href="<?= site_url();?>" data-target="slide-out" class="sidenav-trigger show-on-small hide-on-up brand-logo center" style="font-size: 16px;text-decoration: underline;letter-spacing: 2px;">System PKS</a>
            <ul class="right hide-on-med-and-down">
              <li><a href="<?= base_url().'register';?>">Register User</a></li>
              <li><a href="#">Setting</a></li>
              <li><a href="<?= base_url('logout');?>">Logout</a></li>
            </ul>
          </div>
        </nav>
        <ul id="slide-out" class="sidenav sidenav-fixed indigo lighten-5">
        <!-- <ul id="slide-out" class="sidenav sidenav-fixed indigo lighten-5"> -->
          <li>
            <div class="user-view">
              <div class="background">
                <!-- <img class="responsive-img" src="<?= base_url().'gambar/profile/user.png';?>"> -->
              </div>
              <img class="circle responsive-img" src="<?= base_url().'gambar/profile/user.png';?>">
              <span class="black-text name" style="text-transform: capitalize;">Hi, <b><?= $_SESSION['nama'];?>!</b></span>
              
            </div>
          </li>
          <ul class="collapsible">
            <li class="bold show-on-small hide-on-up">
              <a href="<?= base_url();?>" class="waves-effect waves-teal show-on-small hide-on-up <?= current_active('home',$page);?>">Home</a>
            </li>
            

            <li class="<?= current_active('perusahaan',$page);?>">
              <a class="collapsible-header">New Vendor</a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="<?= base_url().'vendor/perusahaan';?>" class="<?= current_active('perusahaan',$page);?>">Perusahaan</a></li>
                  <li><a href="<?= base_url().'vendor/pengurus';?>">Pengurus</a></li>
                  <li><a href="<?= base_url().'vendor/document_akte';?>">Document Akte</a></li>
                  <li><a href="<?= base_url().'vendor/document_usaha';?>">Document Usaha</a></li>
                  <li><a href="<?= base_url().'vendor/document_surat';?>">Document Surat</a></li>
                </ul>
              </div>
            </li>

            <li class="bold">
              <a href="<?= base_url().'tdr';?>" class="waves-effect waves-teal <?= current_active('tdr',$page);?>">New TDR</a>
            </li>
            <li class="bold">
              <a href="<?= base_url().'pks';?>" class="waves-effect waves-teal <?= current_active('pks',$page);?>">New PKS</a>
            </li>
            <!-- <li class="bold">
              <a href="<?= base_url().'tdr';?>" class="waves-effect waves-teal">New Procurement</a>
            </li>
            <li class="bold">
                <a href="<?= base_url().'pengumuman';?>" class="waves-effect waves-teal">New Tgl Kembali Procurement</a>
            </li> -->
          </ul>
        </ul>
        <!-- Page Layout here -->
    
        <div class="fixed">
          Copyrights Reza reserved &copy 2018
        </div>
  <!-- end page Layout-->
      <!--JavaScript at end of body for optimized loading-->
      <script src="<?= base_url().'assets/js/jquery.min.js';?>"></script>
      <script src="<?= base_url().'assets/js/select2.min.js';?>"></script>
      <!-- <script src="<?= base_url().'assets/js/select2-materialize.js';?>"></script> -->
      <script src="<?= base_url().'assets/js/sweetalert2.min.js';?>"></script>
      <script src="<?= base_url().'assets/materialize/js/materialize.min.js';?>"></script>
      <script src="<?= base_url().'assets/datatables/jquery.dataTables.min.js';?>"></script>
      <script src="<?= base_url().'assets/datatables/Buttons-1.5.1/js/datatables.buttons.min.js';?>"></script>
      <script src="<?= base_url().'assets/datatables/buttons.html5.min.js';?>"></script>
      <script src="<?= base_url().'assets/js/moment.js';?>"></script>
      <script>
  $('.waiting').show();

  $(document).ready(function(){
    $('.waiting').hide();
    M.updateTextFields();
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.sidenav-unfixed').hide();
  });
</script>

    </body>
  </html>
