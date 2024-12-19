<h1 class="text-dark text-center my-4">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-dark mb-4">
<div class="row g-4">
  <!-- Total Suppliers -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-navy elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-truck-loading"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Total Suppliers</span>
        <span class="info-box-number display-6 text-primary">
          <?php 
            $supplier = $conn->query("SELECT * FROM supplier_list")->num_rows;
            echo number_format($supplier);
          ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Orders to Check -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-warning elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-clipboard-check"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Orders to Check</span>
        <span class="info-box-number display-6 text-warning">
          <?php 
            if (isset($_SESSION['userdata']['type'])) {
              $type = $_SESSION['userdata']['type'];
              $po = 0;

              if ($type == 2) $po = $conn->query("SELECT * FROM po_list WHERE `status_sales` = 0")->num_rows;
              if ($type == 3) $po = $conn->query("SELECT * FROM po_list WHERE `status_finance` = 0")->num_rows;
              if ($type == 4) $po = $conn->query("SELECT * FROM po_list WHERE `status` = 0")->num_rows;

              if ($type == 1) {
                $director = $conn->query("SELECT * FROM po_list WHERE `status` = 0")->num_rows;
                $sales = $conn->query("SELECT * FROM po_list WHERE `status_sales` = 0")->num_rows;
                $finance = $conn->query("SELECT * FROM po_list WHERE `status_finance` = 0")->num_rows;
                echo "Director: " . number_format($director) . "<br>Sales: " . number_format($sales) . "<br>Finance: " . number_format($finance);
              } else {
                echo number_format($po);
              }
            }
          ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Total Items -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-success elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-boxes"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Total Items</span>
        <span class="info-box-number display-6 text-success">
          <?php 
            $item = $conn->query("SELECT * FROM item_list")->num_rows;
            echo number_format($item);
          ?>
        </span>
      </div>
    </div>
  </div>
  <!-- Approved PO -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-primary elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-file-invoice"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Approved Purchase Orders</span>
        <span class="info-box-number display-6 text-primary">
          <?php 
            $po_approved = $conn->query("SELECT * FROM po_list WHERE `status` = 1 AND `status_sales` = 1 AND `status_finance` = 1")->num_rows;
            echo number_format($po_approved);
          ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Denied PO -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-danger elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-times-circle"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Denied Purchase Orders</span>
        <span class="info-box-number display-6 text-danger">
          <?php 
            $po_denied = $conn->query("SELECT * FROM po_list WHERE `status` = 2 AND `status_sales` = 2 AND `status_finance` = 2")->num_rows;
            echo number_format($po_denied);
          ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Pending PO -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-secondary elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-hourglass-half"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Pending Purchase Orders</span>
        <span class="info-box-number display-6 text-secondary">
          <?php 
            $po_pending = $conn->query("SELECT * FROM po_list WHERE `status` = 0 OR `status_sales` = 0 OR `status_finance` = 0")->num_rows;
            echo number_format($po_pending);
          ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Approved PR -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-primary elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-file-invoice"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Approved Purchase Requisitions</span>
        <span class="info-box-number display-6 text-primary">
          <?php 
            $pr_approved = $conn->query("SELECT * FROM pr_list WHERE `status` = 1 AND `status_finance` = 1")->num_rows;
            echo number_format($pr_approved);
          ?>
        </span>
      </div>
    </div>
  </div>

  <!-- Denied PR -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-lg border rounded bg-gradient-light">
      <span class="info-box-icon bg-danger elevation-2 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-times-circle"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Denied Purchase Requisitions</span>
        <span class="info-box-number display-6 text-danger">
          <?php 
            $pr_denied = $conn->query("SELECT * FROM pr_list WHERE `status` = 2 OR `status_finance` = 2")->num_rows;
            echo number_format($pr_denied);
          ?>
        </span>
      </div>
    </div>
  </div>
  
  <!-- Pending PR -->
  <div class="col-12 col-sm-6 col-md-4">
    <div class="info-box shadow-sm border rounded bg-light">
      <span class="info-box-icon bg-secondary elevation-1 d-flex align-items-center justify-content-center rounded-circle"><i class="fas fa-hourglass-half"></i></span>
      <div class="info-box-content text-center">
        <span class="info-box-text fw-bold">Pending Purchase Requisitions</span>
        <span class="info-box-number display-6 text-secondary">
          <?php 
            $po_pending = $conn->query("SELECT * FROM pr_list WHERE `status` = 0 OR `status_finance` = 0")->num_rows;
            echo number_format($po_pending);
          ?>
        </span>
      </div>
    </div>
  </div>
</div>

<!-- Add custom styling or animations here -->
<style>
  .info-box {
    transition: transform 0.2s ease-in-out;
  }
  .info-box:hover {
    transform: scale(1.05);
  }
  .info-box-icon {
    width: 80px;
    height: 80px;
    font-size: 2rem;
  }
  .info-box-number {
    font-weight: bold;
  }
</style>
