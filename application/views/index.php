
  <!-- <ul id="slide-out" class="sidenav sidenav-fixed">
    <li><div class="user-view">
      <div class="background">
        <img class="responsive-img" src="<?= base_url().'gambar/profile/avatar.jpg';?>">
      </div>
      <img class="circle responsive-img" src="<?= base_url().'gambar/profile/Koala.jpg';?>">
      <span class="black-text name">Reza</span>
      
    </div></li>
    <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
    <li><a href="#!">Second Link</a></li>
      <li class="show-on-small hide-on-med-and-up"><a href="sass.html">PKS</a></li>
      <li class="show-on-small hide-on-med-and-up"><a href="badges.html">Pengadaan</a></li>
      <li class="show-on-small hide-on-med-and-up"><a href="collapsible.html">Register Surat</a></li>
      <li class="show-on-small hide-on-med-and-up"><a href="mobile.html">TDR</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul> -->
  <!-- Page Layout here -->
  <style>
  div#copyright {
      position: fixed;
      bottom: 0;
      vertical-align: middle;
      width: 100%;
      border:1px solid #ff3d00;
      background-color: #ff3d00;
      box-shadow: 10px 10px 5px grey;
    }
    #isi{
      text-align: center;
      color: white;
      margin: auto;
      padding: 10px;
      font-family: Arial, Helvetica, sans-serif;
      
      box-shadow: 0px 0px 10px grey;
      text-shadow: 0 0 3px #FF0000;
    }
  </style>
    <div class="row first">
      <div class="col push-l3 l9 s12 collection">
        <div class="collection-item teal white-text">Pengumuman on <?php $date=date_create("2018-09-13 10:57:00",timezone_open("Asia/Jakarta"));echo date_format($date,"d-m-Y H:i:s");?></div>
        <div class="collection-item white"  id="pengumuman1"></div>
        
      </div>
    </div>
    <div id="copyright">
      <div id="isi">
        Reza ~ Copyright &copy 2018
      </div>
    </div>


<script>
  
  $(document).ready(function(){
  $('.fixed').hide();
    })
  //var kata = " Untuk penambahan modul/menu mohon hubungi reza atau email: <a href='mailto:Muhamad.Reza@bni.co.id'>Muhamad.Reza@bni.co.id</a> / <a href='mailto:reza.2207@gmail.com'>reza.2207@gmail.com</a>";
  var kata = " Untuk penambahan modul/menu mohon hubungi reza atau email: Muhamad.Reza@bni.co.id / reza.2207@gmail.com";
  var inkata = 0;
  var kecepatankatamuncul = 50;

  setInterval(function(){

    var target = $('#pengumuman1');
    target.append(kata[inkata]);
    inkata++; 
  }, kecepatankatamuncul);

</script>