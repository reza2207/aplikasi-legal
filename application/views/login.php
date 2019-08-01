
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="<?= base_url().'assets/font-awesome-4.7.0/css/font-awesome.css';?>" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?= base_url().'assets/materialize/css/materialize.min.css';?>"  media="screen,projection"/>
      <link href="<?= base_url().'assets/css/sweetalert2.min.css';?>" rel="stylesheet">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <title><?= $title == "" ? "" : $title;?></title>
    <body class="blue lighten-4">
        <nav>
          <div class="nav-wrapper deep-orange darken-3">

            <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large brand-logo center">System PKS</a>
          </div>
        </nav>

      <!-- Page Layout here -->
        <div class="row col l12 s12">
          <?= form_open('', 'style="top: 20%;position: absolute;padding-top: 10px;box-shadow: 10px 10px 5px grey;", class="card-panel col s10 push-s1 l4 push-l4"');?>
          <!-- <form class="card-panel col s10 push-s1 l4 push-l4" style="top: 20%;position: absolute;padding-top: 10px"> -->
            <div class="row center-align">
              <div class="input-field col s12 l6 push-l3">
                <input id="username" type="text" class="validate">
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
               <div class="input-field col s12 l6 push-l3">
                <input id="password" type="password" class="validate">
                <label for="password">Password</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col l8 push-l4">
                <a href="#">Lupa Password?</a>
                <button class="waves-effect waves-light deep-orange darken-1 btn" type="reset">Reset</button>
                <button class="waves-effect waves-light btn" type="submit" id="login">Login</button>
              </div>
            </div>
            <div class="row center orange-text accent-4" id="jam">
            </div>
            
          <?= form_close();?>
          <!-- </form> -->
        </div>
        <div class="row" style="padding-top: 480px;width: 100%">
          <div class="col l12">
            <marquee><b>BNI - Divisi Bisnis Kartu Copyrights &copy <a href="mailto: reza.220793@gmail.com" style="color:#ff9100">Reza</a> Reserved 2018</b></marquee>
          </div>
        </div>
      <!--JavaScript at end of body for optimized loading-->
      <script src="<?= base_url().'assets/js/jquery.min.js';?>"></script>
      <script src="<?= base_url().'assets/js/moment.js';?>"></script>
      <script src="<?= base_url().'assets/js/sweetalert2.min.js';?>"></script>
      <script type="text/javascript" src="<?= base_url().'assets/materialize/js/materialize.min.js';?>"></script>
      
      <script>


  $(document).ready(function(){
    $('.sidenav').sidenav();
    setInterval(jam, 1000);
    function jam(){

      var jam = moment().format('dddd, MMMM Do YYYY, h:mm:ss a'); // September 20 2018, 9:18:43 pagi
      $('#jam').html(jam);

    }
    
    
    $('#login').on('click', function(e){
      e.preventDefault();
      var username = $('#username').val();
      var password = $('#password').val();

      $.ajax({
        type: 'POST',
        url : "<?= base_url().'login/login';?>",
        data : {username: username, password: password},
        success: function(response){
          
          var data = JSON.parse(response);
          if(data.status == 'success'){
          swal({
              type: data.status,
              text: data.pesan,
              }).then(function(){
                window.location.href="<?=base_url().'welcome';?>"; 
              })
          }else{
            swal({
              type: data.status,
              text: data.pesan,
              })
          }

        }, error: function(){
          console.log('Occured error!')
        }
      })
    })

  });
</script>

    </body>
  </html>
        