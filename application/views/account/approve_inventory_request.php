<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Approve Inventory Request</h1>
				<small>Inventory Request Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="<?php echo base_url("account/inventory_issue/index"); ?>">Inventory Request Master</a></li>
					<!--<li><a href="<?php echo base_url("account/inventory_issue/index"); ?>">Inventory Issue List</a></li>-->
					<li class="active">Approve Inventory Request</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Inventory Request Information</h4>
						</div>
					</div>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/inventory_request/approve_inventory_request"); ?>">
							<?php

							$product = $info['product'];							
							if(sizeof($info))
							{	?>
								<div class="row form-group">
									<div class="col-sm-3">
										<h4>Production Date: </h4>
										<?php echo $info['production_date']; ?>
									</div>
									<div class="col-sm-3">
										<h4>Request Code: </h4>
										<?php echo $info['inventory_request_code']; ?>
									</div>
									<div class="col-sm-3">
										<h4>Added By: </h4>
										<?php echo $info['first_name'].' '.$info['last_name']; ?>
									</div>
									<div class="col-sm-3">
										<h4>Date: </h4>
										<?php echo date('d-m-Y', strtotime($info['add_date'])); ?>
									</div>
								</div>		
						
								<?php
								for($j=0; sizeof($product)>$j; $j++)
								{
									?>
									<div class="table-responsive m-b-20">
										<table class="table table-bordered">
											<thead>
												<tr class="t_head">
													<th>Product Code</th>
													<th>Product Name</th>
													<th>Request Quantity</th>									
													<th>Issued Quantity</th>									
													<th>Pending Quantity</th>									
													<th>Notes</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$product = $info['product'];
												
												if(sizeof($product)>0)
												{
													for($j=0; sizeof($product)>$j; $j++)
													{
														$pending_qty= $product[$j]['product_qty'] - $product[$j]['issued_qty'];
														?>
														<tr>
															<td>
																<div>
																	<strong><?php echo $product[$j]['product_code']; ?></strong>
																</div>
															</td>
															<td><?php echo $product[$j]['product_name'];?></td>
															<td><?php echo $product[$j]['product_qty'];?></td>
															<td>
															<?php
																if($product[$j]['issued_qty']!='')
																{
																	echo $product[$j]['issued_qty'];
																}else{
																	echo "0";
																}
															
															?></td>
															
															<td>
															<div class="form-group" style="width: 84px;">
																<div class="col-sm-12">
																	<input type="hidden" name="inventory_product_id[]" value="<?php echo $product[$j]['id'];?>">
																	<input type="hidden" name="request_qty[]" value="<?php echo $product[$j]['product_qty'];?>">
																	<input type="hidden" name="issued_qty[]" value="<?php echo $product[$j]['issued_qty'];?>">
																	<input type="text" class="form-control" name="approve_qty[]" id="approve_qty<?php echo $j;?>" value="<?php echo $pending_qty;?>" onkeyup="integer('approve_qty<?php echo $j;?>')">
																</div>
															</div>
															</td>
															<td><?php echo $product[$j]['notes'];?></td>
														</tr>
													   <?php
													}
												}
												else
												{
													?>
													<tr>
														<td colspan="9">
															Sorry no record found to display...
														</td>
													</tr>
													<?php	
												}
											?>	
											</tbody>
										</table>
									</div>
									<?php 
								}
								?>
								
								<input type="hidden" name="inventory_request_id" value="<?php echo $info['id']; ?>">
								<div class="row">
								<div class="col-sm-4">
									<div class="form-group note_div">
										<label for="note" class="form-control-label" id="note_lbl"> Note </label>
										<textarea rows="3" cols="50" type="text" class="form-control" id="note" name="note" placeholder="Note" onkeyup="change_status('note_div')"></textarea>
									</div>
								</div>
							</div>							
							<div class="row">
								<div class="col-sm-4" style="padding-top:23px;">
									<div class="form-group">
										<button type="submit" id="test" class="btn btn-base pull-left">Approve </button>
										<a href="<?php echo base_url("account/inventory_issue/index") ?>">
											<button type="button"  style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div>
								<?php
							}	
							?>	
					</div>
				</div>
			</div>
		
		</div>
		</form>
		</div> 
</div>
<script>
	$(document).on('click', '.add', function()
	{
		var $tr    = $(this).closest('.btnSectionClone');
		var $clone = $tr.clone();
		$clone.find('.add').replaceWith('<td class = "remove btn btn-sm btn-danger btn-top">Remove</td>');
		$clone.find(":text").val("");
		$clone.find('.select2-container--default').remove();
		$clone.find('#product_name').select2();
				  
		$tr.before($clone);		
	});
	
	$(document).on('click', '.remove', function(){		
		$(this).closest('.btnSectionClone').remove();
	}); 
	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}

	$("#frm").submit(function(e)
	{
		var flag="True";
		var department_name = $("#department_name").val();
			
		if(department_name=="")
		{
			$(".designation_name_div").addClass("has-danger");
			flag="False";
		}

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}
	});

	$('.datetimepicker2').datetimepicker({
		format:'d-m-Y',
		defaultDate:'<?php echo date("d.m.Y"); ?>', // it's my birthda
		timepicker:false
	});

</script>