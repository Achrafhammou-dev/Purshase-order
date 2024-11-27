<h1 class="text-dark">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-dark">
<div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-navy elevation-1"><i class="fas fa-truck-loading"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Suppliers</span>
                <span class="info-box-number">
                  <?php 
                    $supplier = $conn->query("SELECT * FROM supplier_list")->num_rows;
                    echo number_format($supplier);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-boxes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Items</span>
                <span class="info-box-number">
                  <?php 
                     $item = $conn->query("SELECT * FROM item_list ")->num_rows;
                     echo number_format($item);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <!-- /.col -->


           <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Approve P.O.</span>
                <span class="info-box-number">
                <?php 
$po_approved = $conn->query("SELECT * FROM po_list WHERE `status` = 1 AND `status_sales` = 1 AND `status_finance` = 1")->num_rows;
echo number_format($po_approved);
?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-pen elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Orders to Check</span>
                <span class="info-box-number">


                <?php if (isset($_SESSION['userdata']['type']) && ($_SESSION['userdata']['type'] == 2)): 
                  $po = $conn->query("SELECT * FROM po_list where `status_sales` = 0 ")->num_rows;
                  echo number_format($po);?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userdata']['type']) && ($_SESSION['userdata']['type'] == 3)): 
                  $po = $conn->query("SELECT * FROM po_list where `status_finance` = 0 ")->num_rows;
                  echo number_format($po);?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userdata']['type']) && ($_SESSION['userdata']['type'] == 4)): 
                  $po = $conn->query("SELECT * FROM po_list where `status` = 0 ")->num_rows;
                  echo number_format($po);?>
            <?php endif; ?>

            <?php if (isset($_SESSION['userdata']['type']) && ($_SESSION['userdata']['type'] == 1)): 
                  $po = $conn->query("SELECT * FROM po_list where `status` = 0 ")->num_rows;
                  echo "By Director : " . number_format($po)."<br>";

            $po = $conn->query("SELECT * FROM po_list where `status_sales` = 0 ")->num_rows;
            echo "By sales : " . number_format($po) ."<br>";
           
            $po = $conn->query("SELECT * FROM po_list where `status_finance` = 0 ")->num_rows;
            echo "By Finance : " . number_format($po);?>
            <?php endif; ?>




                  <!-- <?php 
                     $po = $conn->query("SELECT * FROM po_list where `status` = 0 OR `status_sales` = 0 OR `status_finance` =0 ")->num_rows;
                     echo number_format($po);
                  ?> -->
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Denied PO</span>
                <span class="info-box-number">
                  <?php 
                     $po = $conn->query("SELECT * FROM po_list where `status` = 2 AND `status_sales` = 2 AND `status_finance` =2 ")->num_rows;
                     echo number_format($po);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-pen elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending PO</span>
                <span class="info-box-number">
                  <?php 
                     $po = $conn->query("SELECT * FROM po_list where `status` = 0 OR `status_sales` = 0 OR `status_finance` =0 ")->num_rows;
                     echo number_format($po);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

<br>

          



          <!-- /.col -->
        </div>
<div class="container">
  
</div>
