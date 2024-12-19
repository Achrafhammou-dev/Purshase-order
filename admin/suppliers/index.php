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
     .table th:nth-child(2),
    .table td:nth-child(2)
     {
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
		<h3 class="card-title">List of Suppliers</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="20%">
					<col width="20%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
						<th>#</th>
						<th>Date Created</th>
						<th>Supplier</th>
						<th>Contact Person</th>
						<th>Address</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$qry = $conn->query("SELECT * from `supplier_list` order by (`name`) asc ");
					while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td><?php echo $row['name'] ?></td>
							<td>
								<p class="m-0">
									<?php echo $row['contact_person'] ?><br>
									<?php echo $row['contact'] ?>
								</p>
							</td>
							<td class='truncate-3' title="<?php echo $row['address'] ?>"><?php echo $row['address'] ?></td>
							<td class="text-center">
								<?php if($row['status'] == 1): ?>
									<span class="badge badge-success"><i class="fa fa-toggle-on" aria-hidden="true"></i></span>
								<?php else: ?>
									<span class="badge badge-secondary"><i class="fa fa-ban" aria-hidden="true"></i></span>
								<?php endif; ?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-info text-primary"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Supplier permanently?","delete_supplier",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Register New Supplier","suppliers/manage_supplier.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Supplier's Details","suppliers/view_details.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Supplier's Details","suppliers/manage_supplier.php?id="+$(this).attr('data-id'))
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_supplier($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_supplier",
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