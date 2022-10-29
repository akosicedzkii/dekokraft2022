<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo "CHARGE SLIP"?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script src="chrome-extension://mooikfkahbdckldjjndioackbalphokd/assets/prompt.js"></script></head>

<style>
.avoidBreak {
    border: 2px solid;
    page-break-inside:avoid;
}
@media only print {
   .wrapper {
     width: auto;
     height: auto;
     overflow: visible;
   }

    body
    {
        font-size:10px;
    }
}

</style>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="col-xs-12 text-center">
           <p class="text-uppercase m-b"><?php echo SITE_NAME;?></p>
           <p><?php echo nl2br(COMPANY_ADDRESS);?></p>
      </div>
    
      <div class="row">
          <br><br><br><br>
          <center><h4>Charge Slip</h4></center>

        <div class="container">
        <div class="row">
            <div class="col-md-4">
              <?php echo "Charge Slip ID: ".$charge_slip->id; ?>
            </div>
            <div class="col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <?php echo "Date Created: ".date("Y-m-d",strtotime($charge_slip->date_created)); ?>
            </div>
            <div class="col-md-8"></div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <?php echo "To: ".$charge_slip->to; ?>
            </div>
            <div class="col-md-8"></div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <?php echo "Client: ".$client->customer_name; ?>
              </div>
            <div class="col-md-8"></div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <?php echo "Invoice ID: ".$charge_slip->invoice_id; ?>
              
            </div>
            <div class="col-md-8"></div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <b><center><h4><?php echo ucfirst($charge_slip->charge_slip_type); ?> </h4> </center></b>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <table class="table" style="font-size:12px;margin:20px;">
          <thead>
             <tr>
              <th>Code</th> 
              <th>Quantity</th> 
              <th>Location</th> 
              <th>Description</th> 
            </tr>
          </thead>
         
          <tbody>
            <?php foreach($cs_items as $item){?>
            <tr>
              <td><?php echo $item->code; ?></td> 
              <th><?php echo $item->quantity; ?></td> 
              <td><?php echo $item->location; ?></td> 
              <td><?php echo $item->description; ?></td> 
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <div class="container">

        <br>
        <div class="row">
            <div class="col-md-4">
              <?php echo "Checked By: <u>".$charge_slip->checked_by."</u>"; ?>
            </div>
            <div class="col-md-8"></div>
          </div>

          <br>
          <div class="row">
            <div class="col-md-4">
              <?php echo "Released By:  <u>".$charge_slip->released_by."</u>"; ?>
            </div>
            <div class="col-md-8"></div>
          </div>

          
          <br>
          <div class="row">
            <div class="col-md-4">
              <?php echo "Prepared By:  <u>".$charge_slip->prepared_by."</u>"; ?>
            </div>

            <div class="col-md-8"></div>
          </div>
          <br>
          <br>
          <br>
          <div class="row">

          <div class="col-md-8"></div>
            <div class="col-md-4 pull-right">
              <?php echo "Noted By: <u>".$charge_slip->noted_by."</u>"; ?>
            </div>
          </div>

          <br>
          
          <div class="row">

          <div class="col-md-8"></div>
            <div class="col-md-4 pull-right">
              <?php echo "Received By:  <u>".$charge_slip->received_by."</u>"; ?>
              
            </div>

          </div>
         
        </div>
      </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<script>

$(".table td, .table th").each(function(){ $(this).css("width",  $(this).width() + "px")  });
$(".table tr").wrap("<div class='avoidBreak'></div>");
//window.print();

</script>

</body></html>
