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
    .table td:nth-child(4) {
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

<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of System Users</h3>
		<div class="card-tools">
			<a href="?page=user/manage_user" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<th>Avatar</th>
						<th>Name</th>
						<th>Username</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					// Exclude admin (id = 1) and the current logged-in user
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name from `users` where id != '1' and id != '{$_settings->userdata('id')}' order by concat(firstname,' ',lastname) asc ");
					while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class="text-center"><img src="<?php echo validate_image($row['avatar']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar"></td>
							<td><?php echo ucwords($row['name']) ?></td>
							<td ><p class="m-0 truncate-1"><?php echo $row['username'] ?></p></td>
							<td>
								<?php 
								// Map user types to labels
								switch ($row['type']) {
									case 1: echo 'Administrator'; break;
									case 2: echo 'Sales'; break;
									case 3: echo 'Finance'; break;
									case 4: echo 'Director'; break;
									default: echo 'Unknown'; break;
								}
								?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item" href="?page=user/manage_user&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
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
			_conf("Are you sure to delete this User permanently?","delete_user",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Users.php?f=delete",
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
