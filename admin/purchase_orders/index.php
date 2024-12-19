<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	/* Responsive table adjustments for mobile */
@media (max-width: 768px) {
    /* Table headers */

	.card-body{
		flex: 1 1 auto;
	    min-height: 1px;
		padding: 0rem;
	}

    /* Table body rows */
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


    /* Add spacing between rows */
    .table tr {
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    /* Add labels for each column */
    .table td::before {
        content: attr(data-label);
        font-weight: bold;
        display: block;
        text-transform: uppercase;
        color: #555;
        margin-bottom: 5px;
    }

    /* Center align actions */
    .dropdown-menu {
        width: 100%;
        text-align: center;
    }

    /* Reduce padding and font size for table cells */
    .table td {
        padding: 10px;
        font-size: 14px;
    }

    /* Adjust badge layout */
    .badge {
        margin: 2px 0;
    }

    /* Action button full width */
    .btn-flat {
        width: 100%;
        margin: 5px 0;
    }
}

/* CSS pour écrans de petite taille (max-width: 768px) */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Réduction de la taille de la police */
    .table th, 
    .table td {
        font-size: 12px;
        padding: 6px;
    }

    /* Suppression ou masquage des colonnes non essentielles */
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table th:nth-child(5),
    .table td:nth-child(5) {
        display: none;
    }

    /* Les boutons d'action occupent l'espace complet */
    .dropdown-menu {
        width: 100%;
    }

    .btn {
        font-size: 12px;
        padding: 4px 6px;
    }

    .card-header .btn {
        font-size: 14px;
    }

    /* Affichage des badges en mode bloc pour éviter les débordements */
    .badge {
        display: block;
        margin-bottom: 3px;
    }
}

/* CSS pour écrans très petits (max-width: 576px) */
@media (max-width: 576px) {
    .card-title {
        font-size: 16px;
    }

    .table th, 
    .table td {
        font-size: 10px;
        padding: 4px;
    }

    .table th:nth-child(3),
    .table td:nth-child(3) {
        display: none;
    }

    /* Alignement centré */
    .table td, .table th {
        text-align: center;
    }
}

</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Purchase Orders</h3>
		<div class="card-tools">
			<a href="?page=purchase_orders/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<div class="table-responsive">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="5%">
					<col width="15%">
					<col width="5%">
					<col width="5%">
					<col width="5%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
						<th>#</th>
						<th>Date Created</th>
						<th>PO #</th>
						<th>Supplier</th>
						<th >Items</th>
						<th class="text-center">Total Amount</th>
						<th>Sales</th>
						<th>Finance</th>
						<th>DG</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated)");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['po_no'] ?></td>
							<td class=""><?php echo $row['sname'] ?></td>
							<td class="text-center"><?php echo number_format($row['item_count']) ?></td>
							<td class="text-center"><?php echo number_format($row['total_amount']) ?></td>
							<td class="text-center">
								<?php 
									switch ($row['status_sales']) {
										case '1':
											echo '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
											break;
										case '2':
											echo '<span class="badge badge-danger"><i class="fas fa-ban"></i></span>';
											break;
										default:
											echo '<span class="badge badge-secondary"><i class="fas fa-hourglass-half" aria-hidden="true"></i></span>';
											break;
									}
								?>
								</td>
								<td class="text-center">
								<?php 
									switch ($row['status_finance']) {
										case '1':
											echo '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
											break;
										case '2':
											echo '<span class="badge badge-danger"><i class="fas fa-ban"></i></span>';
											break;
										default:
											echo '<span class="badge badge-secondary"><i class="fas fa-hourglass-half" aria-hidden="true"></i></span>';
											break;
									}
								?>
								</td>
								<td class="text-center">
								<?php 
									switch ($row['status']) {
										case '1':
											echo '<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
											break;
										case '2':
											echo '<span class="badge badge-danger"><i class="fas fa-ban"></i></span>';
											break;
										default:
											echo '<span class="badge badge-secondary"><i class="fas fa-hourglass-half" aria-hidden="true"></i></span>';
											break;
									}
								?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
									<div class="dropdown-menu" role="menu">
									<?php if (isset($_SESSION['userdata']['type']) && ($_SESSION['userdata']['type'] == 1 || $_SESSION['userdata']['type'] == 2)): ?>
								<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="?page=purchase_orders/manage_po&id=<?php echo $row['id'] ?>">
										<span class="fa fa-edit text-primary"></span> Edit
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
										<span class="fa fa-trash text-danger"></span> Delete
									</a>
								<?php endif; ?>
								<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="?page=purchase_orders/edit_status&id=<?php echo $row['id'] ?>">
										<span class="fa fa-edit text-primary"></span> Edit Status
									</a>
									<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?page=purchase_orders/view_po&id=<?php echo $row['id'] ?>">
									<span class="fa fa-eye text-primary"></span> View
								</a>
							</div>

							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this rent permanently?","delete_rent",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","purchase_orders/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.renew_data').click(function(){
			_conf("Are you sure to renew this rent data?","renew_rent",[$(this).attr('data-id')]);
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_rent($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	function renew_rent($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=renew_rent",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>