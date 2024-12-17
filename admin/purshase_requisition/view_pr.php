<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `pr_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>

<?php if ($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif; ?>

<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM `pr_list` WHERE id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<style>
    @media (max-width: 768px) {
    /* General Adjustments */
    .card-body {
        padding: 0.5rem;
    }

    .table {
        font-size: 12px;
    }

    /* Table Responsive */
    #item-list {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    #item-list thead th,
    #item-list tbody td {
        text-align: center;
        padding: 0.5rem;
    }

    /* Title and Vendor Details */
    .text-centre {
        font-size: 14px;
    }

    .col-6, .col-4, .col-3 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 1rem;
    }

    /* Logo Alignment */
    center img {
        max-height: 80px;
    }

    /* Buttons */
    .btn {
        font-size: 12px;
        padding: 0.25rem 0.5rem;
    }

    /* Status Buttons */
    .btn-flat {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 0.5rem;
    }

    /* Table Cloning */
    #item-clone input {
        font-size: 12px;
        padding: 0.25rem;
    }

    /* Footer Adjustments */
    tfoot th, tfoot td {
        font-size: 12px;
    }
}

    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
	/* Chrome, Safari, Edge, Opera */
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		}

		/* Firefox */
		input[type=number] {
		-moz-appearance: textfield;
		}
		[name="tax_percentage"],[name="discount_percentage"]{
			width:5vw;
		}
</style>


<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title">
            <?php echo isset($id) ? "View Purchase Requisition Details" : "New Purchase Requisition" ?>
        </h3>
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button">
                <i class="fa fa-print"></i> Print
            </button>
            <?php if (isset($_SESSION['userdata']['type']) && $_SESSION['userdata']['type'] == 1): ?>
                <a class="btn btn-sm btn-flat btn-primary" href="?page=purshase_requisition/manage_pr&id=<?php echo $id ?>">Edit</a>
            <?php endif; ?>
            <a class="btn btn-sm btn-flat btn-default" href="?page=purshase_requisition">Back</a>
        </div>
	</div>

	<div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <p class="m-0"><?php echo $_settings->info('company_name') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-3 d-flex align-items-center">
            
            </div>
            <div class="col-3">
            <center><img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="100px"></center>
            <h4 class="text-centre" style="font-size:15px ; text-align: center ; padding:20px"><b>PURSHASE Requisition</b></h4>
            </div>
        </div>

        <div class="row mb-4" style="margin-top: 4.5rem !important;">
            <div class="col-4">
                <p class="m-0"><b>Requestor</b></p>
                <?php 
                $sup_qry = $conn->query("SELECT * FROM users WHERE id = '{$requestor_id}'");
                $requestor = $sup_qry->fetch_array();
                ?>
                <p class="m-0"><?php echo $requestor['firstname']?></p>
                <p class="m-0"><?php echo $requestor['lastname'] ?></p>
                <p class="m-0"><?php echo $requestor['Email_User'] ?></p>
            </div>
            <div class="col-8 row">
                <div class="col-6">
                    <p class="m-0"><b>P.R #: </b><?php echo $pr_no ?></p>
                </div>
                <div class="col-6">
                    <p class="m-0"><b>Date Created: </b><?php echo date("Y-m-d", strtotime($date_created)) ?></p>
                </div>
            </div>
        </div>

        <p>Please Order the following Item(s):</p>
        <table class="table table-striped table-bordered" id="item-list">
            <colgroup>
                <col width="10%">
                <!-- <col width="10%"> -->
                <col width="20%">
                <col width="50%">
                <!-- <col width="20%"> -->
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr class="bg-navy text-light text-center">
                    <th>Qty</th>
                    <!-- <th>Unit</th> -->
                    <th>Item</th>
                    <th>Description</th>
                    <!-- <th>Assignment</th> -->
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (isset($id)) {
                    $req_items_qry = $conn->query("SELECT o.*, i.name, i.description FROM `req_items` o INNER JOIN item_list i ON o.item_id = i.id WHERE o.`pr_id` = '$id'");
                    $sub_total = 0;
                    while ($row = $req_items_qry->fetch_assoc()):
                        $total_price = $row['quantity'] * $row['unit_price'];
                        $sub_total += $total_price;
                ?>
                <tr>
                    <td class="text-center"><?php echo $row['quantity'] ?></td>
                    <!-- <td><?php echo $row['unit'] ?></td> -->
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['description'] ?> &nbsp; <b> (<?php echo $row['Description_Item'] ?>)</b></td>
                    <!-- <td><?php echo $row['Description_Item'] ?></td> -->
                    <td><?php echo number_format($row['unit_price'], 2) ?></td>
                    <td class="text-right"><?php echo number_format($total_price, 2) ?></td>
                </tr>
                <?php endwhile; } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="text-right">Sub Total</th>
                    <th class="text-right"><?php echo number_format($sub_total, 2) ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Discount (<?php echo $discount_percentage ?? 0 ?>%)</th>
                    <th class="text-right"><?php echo number_format($discount_amount ?? 0, 2) ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Tax (<?php echo $tax_percentage ?? 0 ?>%)</th>
                    <th class="text-right"><?php echo number_format($tax_amount ?? 0, 2) ?></th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <th class="text-right"><?php echo number_format(($sub_total - $discount_amount) + $tax_amount, 2) ?></th>
                </tr>
            </tfoot>
        </table>

        <div>
            <label><b>Deliver Items to (Address):</b></label>
            <p><?php echo $notes ?? ''; ?></p>
        </div>

        <div class="row">
        <div class="col-4">
                <p class="m-0"><b>Requestor</b></p>
                <?php 
                $sup_qry = $conn->query("SELECT * FROM users where id = '{$requestor_id}'");
                $requestor = $sup_qry->fetch_array();
                ?>
                <div>
                    <p class="m-0"><?php echo $requestor['lastname'] ?></p>
                </div>
            </div>
            <div class="col-4">
                        <label for="status" class="control-label">Finance</label>
                        <br>
                        <?php 
									switch($status_finance){
                                        case 1:
                                            echo "<span class='py-2 px-4 btn-flat btn-success'>Approved</span>";
                                            break;
                                        case 2:
                                            echo "<span class='py-2 px-4 btn-flat btn-danger'>Denied</span>";
                                            break;
                                        default:
                                            echo "<span class='py-2 px-4 btn-flat btn-secondary'>Pending</span>";
                                            break;
                                    }
								?>
                    </div>
                    <div class="col-3">
                        <label for="status" class="control-label">Director</label>
                        <br>
                        <?php 
                        switch($status){
                            case 1:
                                echo "<span class='py-2 px-4 btn-flat btn-success'>Approved</span>";
                                break;
                            case 2:
                                echo "<span class='py-2 px-4 btn-flat btn-danger'>Denied</span>";
                                break;
                            default:
                                echo "<span class='py-2 px-4 btn-flat btn-secondary'>Pending</span>";
                                break;
                        }
                        ?>
                    </div>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#print').click(function(e) {
        e.preventDefault();
        start_loader();
        var content = $('<div>').append($('head').clone()).append($('#out_print').clone());
        var nw = window.open("", "", "width=1200,height=950");
        nw.document.write(content.html());
        nw.document.close();
        setTimeout(() => {
            nw.print();
            setTimeout(() => {
                end_loader();
                nw.close();
            }, 300);
        }, 200);
    });
});
</script>
