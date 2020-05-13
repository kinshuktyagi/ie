<div class="content-wrapper">
	  <!-- Main content -->
	<div class="content">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="header-icon"><i class="pe-7s-user-female"></i></div>
			<div class="header-title">
				<h1>Manage Product</h1>
				<small>Product Information.</small>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url("account"); ?>"><i class="pe-7s-home"></i>Home</a></li>
					<li><a href="#">Product Master</a></li>
					<li><a href="<?php echo base_url("account/product/index"); ?>">Product List</a></li>
					<li class="active">Manage Product</li>
				</ol>
			</div>
		</div> <!-- /. Content Header (Page header) -->
		<div class="row">
			 <div class="col-sm-12">
				<div class="panel panel-bd">
					<div class="panel-heading">
						<div class="panel-title">
							<h4>Product Information</h4>
						</div>
					</div>
					<?php					
						/* echo"<pre>";
						print_r($info);
						//print_r($vendor_info);
						exit(); */
					?>
					<div class="panel-body">
						<form method="POST" id="frm" autocomplete="off" action="<?php echo base_url("account/product/update_product"); ?>">
							<div class="row">								
								<div class="col-sm-4">
									<div class="form-group pro_category_div">
										<label for="pro_category" class="form-control-label" id="pro_category_lbl">Product Category</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="pro_category" name="pro_category" onchange="change_status('pro_category_div')">
											<option selected disabled value="">Select Product Category</option>
											<?php
												if(sizeof($product_cat))
												{
													for($i=0;$i<sizeof($product_cat);$i++)
													{
														?>
															<option value="<?php echo $product_cat[$i]['id']; ?>"<?php echo $product_cat[$i]['id']==$info['pro_category']?'selected':''?>><?php echo $product_cat[$i]['raw_material_category_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group pro_sub_category_div">
										<label for="pro_sub_category" class="form-control-label" id="pro_sub_category_lbl">Product Sub Category</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="pro_sub_category" name="pro_sub_category" onchange="change_status('pro_sub_category_div')">
											<option selected disabled value="">Select Product Sub Category</option>
											<?php
												if(sizeof($product_sub_cat))
												{
													for($i=0;$i<sizeof($product_sub_cat);$i++)
													{
														?>
															<option value="<?php echo $product_sub_cat[$i]['id']; ?>"<?php echo $product_sub_cat[$i]['id']==$info['pro_sub_category']?'selected':''?>><?php echo $product_sub_cat[$i]['sub_cat_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group pro_type_div">
										<label for="pro_type" class="form-control-label" id="pro_type_lbl">Product Type</label><span class="red_star">*</span>
										<select class="form-control basic-single" id="pro_type" name="pro_type" onchange="change_status('pro_type_div')">
											<option selected disabled value="">Select Product Type</option>
											<option value="1" <?php echo $info['pro_type']==1?'selected':''?>>Returnable</option>
											<option value="2" <?php echo $info['pro_type']==2?'selected':''?>>Non Returnable</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								
								<div class="col-sm-4">
									<div class="form-group storage_type_div">
										<label for="storage_type" class="form-control-label" id="user_name_lbl">Procurement Type</label><span class="red_star">*</span>
										<select class="form-control" id="storage_type" name="storage_type" onchange="change_status('storage_type_div')">
											<option selected disabled value="">Select Procurement Type</option>
											<?php
												if(sizeof($storage_type))
												{
													for($i=0;$i<sizeof($storage_type);$i++)
													{
														?>
															<option value="<?php echo $storage_type[$i]['id']; ?>" <?php echo $info['storage_type'] ==$storage_type[$i]['id']? 'selected' : ''?>><?php echo $storage_type[$i]['storage_type_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group product_name_div">
										<label for="product_name" class="form-control-label" id="product_name_lbl">Product Name</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" onkeyup="change_status('product_name_div')" value="<?php echo $info['product_name']?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group hsn_code_div">
										<label for="hsn_code" class="form-control-label" id="hsn_code_lbl">HSN Code</label><span class="red_star">*</span>
										<input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="HSN Code" onkeyup="change_status('hsn_code_div')" value="<?php echo $info['hsn_code']; ?>"/>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group trash_hold_div">
										<label for="trash_hold" class="form-control-label" id="trash_hold_lbl">Minimum Quantity</label>
										<input type="text" class="form-control" id="trash_hold" name="trash_hold" placeholder="Minimum Quantity" onkeyup="change_status('trash_hold_div',integer('trash_hold'))" value="<?php echo $info['trash_hold']?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group uom_div">
										<label for="department_name" class="form-control-label" id="uom_lbl">UOM</label><span class="red_star">*</span>
										<select class="form-control" id="uom_name" name="uom" onchange="change_status('uom_div')">
											<option selected disabled value="">Select UOM Type</option>
											
											<?php
												if(sizeof($uom))
												{
													for($i=0;$i<sizeof($uom);$i++)
													{
														?>
															<option value="<?php echo $uom[$i]['uom_id']; ?>" <?php echo $info['uom'] = $uom[$i]['uom_id']? 'selected' : ''?>><?php echo $uom[$i]['uom_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group dimension_div">
										<label for="dimension" class="form-control-label" id="dimension_lbl">Dimension</label>
										<input type="text" class="form-control" id="dimension" name="dimension" placeholder="Dimension" onkeyup="change_status('dimension_div')" value="<?php echo $info['dimension']?>"/>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group stress_relieved_div">
										<label for="stress_relieved" class="form-control-label" id="stress_relieved_lbl">STRESS RELIEVED</label>
										<input type="text" class="form-control" id="stress_relieved" name="stress_relieved" placeholder="STRESS RELIEVED" onkeyup="change_status('stress_relieved_div')" value="<?php echo $info['stress_relieved']?>"/>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
							</div>
							
							
							
							
							
								<div class="col-sm-4" style="<?php if(!in_array(1,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group weight_div">
										<label for="weight" class="form-control-label" id="weight_lbl">Weight</label>
										<input type="text" class="form-control" id="weight" name="weight" placeholder="Weight" onkeyup="change_status('weight_div')" value="<?php echo $info['weight']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(2,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group length_div">
										<label for="thikness" class="form-control-label" id="thikness_lbl">Length</label>
										<input type="text" class="form-control" id="length" name="length" placeholder="Thikness" onkeyup="change_status('length_div')" value="<?php echo $info['length']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(3,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group width_div">
										<label for="width" class="form-control-label" id="material_lbl">Width</label>
										<input type="text" class="form-control" id="width" name="width" placeholder="Width" onkeyup="change_status('width_div')" value="<?php echo $info['width']?>"/>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(4,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group thickness_div">
										<label for="thickness" class="form-control-label" id="weight_lbl">THICKNESS</label>
										<input type="text" class="form-control" id="thickness" name="thickness" placeholder="Thickness" onkeyup="change_status('thickness_div')" value="<?php echo $info['thickness']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(5,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group height_div">
										<label for="thikness" class="form-control-label" id="thikness_lbl">HEIGHT</label>
										<input type="text" class="form-control" id="height" name="height" placeholder="Height" onkeyup="change_status('height_div')" value="<?php echo $info['height']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(6,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group materials_div">
										<label for="width" class="form-control-label" id="material_lbl">MATERIALS</label>
										
										<select class="form-control basic-single" id="materials" name="materials" onchange="change_status('materials_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($materials_info))
												{
													for($i=0;$i<sizeof($materials_info);$i++)
													{
														?>
															<option value="<?php echo $materials_info[$i]['data_id']; ?>"<?php echo $materials_info[$i]['data_id']==$info['materials']?'selected':''?>><?php echo $materials_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(7,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group radius_div">
										<label for="weight" class="form-control-label" id="radius_lbl">RADIUS</label>
										<input type="text" class="form-control" id="radius" name="radius" placeholder="Radius" onkeyup="change_status('radius_div')" value="<?php echo $info['radius']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(8,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group diameter_div">
										<label for="thikness" class="form-control-label" id="diameter_lbl">DIAMETER</label>
										<input type="text" class="form-control" id="diameter" name="diameter" placeholder="Diameter" onkeyup="change_status('diameter_div')" value="<?php echo $info['diameter']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(9,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group volume_div">
										<label for="width" class="form-control-label" id="volume_lbl">Volume</label>
										<input type="text" class="form-control" id="volume" name="volume" placeholder="Volume" onkeyup="change_status('volume_div')" value="<?php echo $info['volume']?>"/>
									</div>
								</div>
							
								<div class="col-sm-4" style="<?php if(!in_array(10,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group shank_length_div">
										<label for="shank_length" class="form-control-label" id="shank_length_lbl">SHANK LENGTH</label>
										<input type="text" class="form-control" id="shank_length" name="shank_length" placeholder="Shank Length" onkeyup="change_status('shank_length_div')" value="<?php echo $info['shank_length']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(11,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group no_of_teeth_div">
										<label for="no_of_teeth" class="form-control-label" id="no_of_teeth_lbl">NO.OF TEETH</label>
										<input type="text" class="form-control" id="no_of_teeth" name="no_of_teeth" placeholder="No Of Teeth" onkeyup="change_status('no_of_teeth_div')" value="<?php echo $info['no_of_teeth']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(12,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group cutting_radius_div">
										<label for="cutting_radius" class="form-control-label" id="cutting_radius_lbl">CUTTING RADIUS</label>
										<input type="text" class="form-control" id="cutting_radius" name="cutting_radius" placeholder="Cutting Radius" onkeyup="change_status('cutting_radius_div')" value="<?php echo $info['cutting_radius']?>"/>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(13,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group weight_div">
										<label for="cutting_tip" class="form-control-label" id="cutting_tip_lbl">CUTTING TIP</label>
										<select class="form-control basic-single" id="cutting_tip" name="cutting_tip" onchange="change_status('cutting_tip_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($cutting_tip_info))
												{
													for($i=0;$i<sizeof($cutting_tip_info);$i++)
													{
														?>
															<option value="<?php echo $cutting_tip_info[$i]['data_id']; ?>"<?php echo $cutting_tip_info[$i]['data_id']==$info['cutting_tip']?'selected':''?>><?php echo $cutting_tip_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(14,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group thread_diameter_div">
										<label for="thread_diameter" class="form-control-label" id="thread_diameter_lbl">THREAD DIAMETER</label>
										<input type="text" class="form-control" id="thread_diameter" name="thread_diameter" placeholder="Thresd Diameter" onkeyup="change_status('thread_diameter_div')" value="<?php echo $info['thread_diameter']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(15,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group thread_pitch_div">
										<label for="width" class="form-control-label" id="thread_pitch_lbl">THREAD PITCH</label>
										<input type="text" class="form-control" id="thread_pitch" name="thread_pitch" placeholder="Thread Pitch" onkeyup="change_status('thread_pitch_div')" value="<?php echo $info['thread_pitch']?>"/>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(16,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group milling_tool_type_div">
										<label for="milling_tool_type" class="form-control-label" id="milling_tool_type_lbl">MILLING TOOL TYPE</label>
										<select class="form-control basic-single" id="milling_tool_type" name="milling_tool_type" onchange="change_status('milling_tool_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($milling_tool_info))
												{
													for($i=0;$i<sizeof($milling_tool_info);$i++)
													{
														?>
															<option value="<?php echo $milling_tool_info[$i]['data_id']; ?>"<?php echo $milling_tool_info[$i]['data_id']==$info['milling_tool_type']?'selected':''?>><?php echo $milling_tool_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(17,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group boring_tool_type_div">
										<label for="boring_tool_type" class="form-control-label" id="boring_tool_type_lbl">BORING TOOL TYPE</label>
										<select class="form-control basic-single" id="boring_tool_type" name="boring_tool_type" onchange="change_status('boring_tool_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($boring_tool_info))
												{
													for($i=0;$i<sizeof($boring_tool_info);$i++)
													{
														?>
															<option value="<?php echo $boring_tool_info[$i]['data_id']; ?>" <?php echo $boring_tool_info[$i]['data_id']==$info['boring_tool_type']?'selected':''?>><?php echo $boring_tool_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(18,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group drilling_tool_type_div">
										<label for="drilling_tool_type" class="form-control-label" id="thread_pitch_lbl">DRILLING TOOL TYPE </label>
										<select class="form-control basic-single" id="drilling_tool_type" name="drilling_tool_type" onchange="change_status('drilling_tool_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($drilling_tool_info))
												{
													for($i=0;$i<sizeof($drilling_tool_info);$i++)
													{
														?>
															<option value="<?php echo $drilling_tool_info[$i]['data_id']; ?>"<?php echo $drilling_tool_info[$i]['data_id']==$info['drilling_tool_type']?'selected':''?>><?php echo $drilling_tool_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(19,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group reaming_tool_type_div">
										<label for="reaming_tool_type" class="form-control-label" id="reaming_tool_type_lbl">REAMING TOOL TYPE</label>
										<select class="form-control basic-single" id="reaming_tool_type" name="reaming_tool_type" onchange="change_status('reaming_tool_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($reaming_tool_info))
												{
													for($i=0;$i<sizeof($reaming_tool_info);$i++)
													{
														?>
															<option value="<?php echo $reaming_tool_info[$i]['data_id']; ?>"<?php echo $reaming_tool_info[$i]['data_id']==$info['reaming_tool_type']?'selected':''?>><?php echo $reaming_tool_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(20,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group threading_tool_type_div">
										<label for="threading_tool_type" class="form-control-label" id="threading_tool_type_lbl">THREADING TOOL TYPE</label>
										<select class="form-control basic-single" id="threading_tool_type" name="threading_tool_type" onchange="change_status('threading_tool_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($threading_tool_info))
												{
													for($i=0;$i<sizeof($threading_tool_info);$i++)
													{
														?>
															<option value="<?php echo $threading_tool_info[$i]['data_id']; ?>"<?php echo $threading_tool_info[$i]['data_id']==$info['threading_tool_type']?'selected':''?>><?php echo $threading_tool_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(21,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group special_tool_type_div">
										<label for="special_tool_type" class="form-control-label" id="special_tool_type_lbl">SPECIAL TOOL TYPE </label>
										<select class="form-control basic-single" id="special_tool_type" name="special_tool_type" onchange="change_status('special_tool_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($special_tool_info))
												{
													for($i=0;$i<sizeof($special_tool_info);$i++)
													{
														?>
															<option value="<?php echo $special_tool_info[$i]['data_id']; ?>" <?php echo $special_tool_info[$i]['data_id']==$info['special_tool_type']?'selected':''?>><?php echo $special_tool_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(22,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group adapter_machine_side_div">
										<label for="adapter_machine_side" class="form-control-label" id="adapter_machine_side_lbl">ADAPTER - MACHINE SIDE </label>
										<select class="form-control basic-single" id="adapter_machine_side" name="adapter_machine_side" onchange="change_status('adapter_machine_side_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof($adapter_machine_side_info))
												{
													for($i=0;$i<sizeof($adapter_machine_side_info);$i++)
													{
														?>
															<option value="<?php echo $adapter_machine_side_info[$i]['data_id']; ?>"<?php echo $adapter_machine_side_info[$i]['data_id']==$info['adapter_machine_side']?'selected':''?>><?php echo $adapter_machine_side_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(23,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group adapter_nose_type_div">
										<label for="adapter_nose_type" class="form-control-label" id="adapter_nose_type_lbl">ADAPTER - NOSE TYPE</label>
										<select class="form-control basic-single" id="adapter_nose_type" name="adapter_nose_type" onchange="change_status('adapter_nose_type_div')">
											<option selected value="">Select </option>
											<?php
												if(sizeof($adapter_nose_info))
												{
													for($i=0;$i<sizeof($adapter_nose_info);$i++)
													{
														?>
															<option value="<?php echo $adapter_nose_info[$i]['data_id']; ?>"<?php echo $adapter_nose_info[$i]['data_id']==$info['adapter_nose_type']?'selected':''?>><?php echo $adapter_nose_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(24,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group pull_stud_type_div">
										<label for="pull_stud_type" class="form-control-label" id="pull_stud_type_lbl">PULL STUD TYPE</label>
										<select class="form-control basic-single" id="pull_stud_type" name="pull_stud_type" onchange="change_status('pull_stud_type_div')">
											<option selected value="">Select</option>
											<?php
												if(sizeof(pull_stud_info))
												{
													for($i=0;$i<sizeof($pull_stud_info);$i++)
													{
														?>
															<option value="<?php echo $pull_stud_info[$i]['data_id']; ?>"<?php echo $pull_stud_info[$i]['data_id']==$info['pull_stud_type']?'selected':''?>><?php echo $pull_stud_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(25,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group accessory_name_div">
										<label for="accessory_name" class="form-control-label" id="accessory_name_lbl">ACCESSORY NAME</label>
										<input type="text" class="form-control" id="accessory_name" name="accessory_name" placeholder="Weight" onkeyup="change_status('accessory_name_div')" value="<?php echo $info['accessory_name']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(26,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group rabge_div">
										<label for="rabge" class="form-control-label" id="thread_diameter_lbl">RANGE</label>
										<input type="text" class="form-control" id="range" name="range" placeholder="Range" onkeyup="change_status('rabge_div')" value="<?php echo $info['range_val']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(27,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group least_count_div">
										<label for="least_count" class="form-control-label" id="thread_pitch_lbl">LEAST COUNT</label>
										<input type="text" class="form-control" id="least_count" name="least_count" placeholder="Least Count" onkeyup="change_status('least_count_div')" value="<?php echo $info['least_count']?>" />
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(28,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group last_calibration_date_div">
										<label for="last_calibration_date" class="form-control-label" id="weight_lbl">LAST CALIBRATION DATE</label>
										<input type="text" class="form-control datetimepicker2" id="last_calibration_date" name="last_calibration_date" placeholder="Date" onkeyup="change_status('last_calibration_date_div')" value="<?php echo $info['last_calibration_date']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(29,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group next_calibration_date_div">
										<label for="thread_diameter" class="form-control-label" id="thread_diameter_lbl">NEXT CALIBRATION DATE</label>
										<input type="text" class="form-control datetimepicker2" id="next_calibration_date" name="next_calibration_date" placeholder="Date" onkeyup="change_status('next_calibration_date_div')" value="<?php echo $info['next_calibration_date']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(30,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group insert_shape_div">
										<label for="insert_shape" class="form-control-label" id="insert_shape_lbl">INSERT SHAPE</label>
										<select class="form-control basic-single" id="insert_shape" name="insert_shape" onchange="change_status('insert_shape_div')">
											<option selected value="">Select MATERIALS</option>
											<?php
												if(sizeof($insert_shape_info))
												{
													for($i=0;$i<sizeof($insert_shape_info);$i++)
													{
														?>
															<option value="<?php echo $insert_shape_info[$i]['data_id']; ?>"<?php echo $insert_shape_info[$i]['data_id']==$info['insert_shape']?'selected':''?>><?php echo $insert_shape_info[$i]['data_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
								</div>
							 
								<div class="col-sm-4" style="<?php if(!in_array(31,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group insert_material_div">
										<label for="insert_material" class="form-control-label" id="weight_lbl">INSERT MATERIAL</label>
										<input type="text" class="form-control" id="insert_material" name="insert_material" placeholder="Insert Material" onkeyup="change_status('insert_material_div')" value="<?php echo $info['insert_material']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(32,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group insert_product_code_div">
										<label for="insert_product_code" class="form-control-label" id="thread_diameter_lbl">INSERT PRODUCT CODE</label>
										<input type="text" class="form-control" id="insert_product_code" name="insert_product_code" placeholder="Insert Product Code" onkeyup="change_status('insert_product_code_div')" value="<?php echo $info['insert_product_code']?>"/>
									</div>
								</div>
								<div class="col-sm-4" style="<?php if(!in_array(33,$sub_cat_data)){ echo'display:none;';} ?>">
									<div class="form-group no_of_cutting_edge_div">
										<label for="no_of_cutting_edge" class="form-control-label" id="thread_pitch_lbl">NO.OF CUTTING EDGES</label>
										<input type="text" class="form-control" id="no_of_cutting_edge" name="no_of_cutting_edge" placeholder="NO Of Cutting Edge" onkeyup="change_status('no_of_cutting_edge_div')" value="<?php echo $info['no_of_cutting_edge']?>"/>
									</div>
								</div>
							
							 
								<div class="col-sm-4">
									<div class="form-group description_div">
										<label for="description" class="form-control-label" id="description_lbl"> Description
										<textarea rows="2" cols="50" type="text" class="form-control" id="description" name="description" placeholder="Description" onkeyup="change_status('description_div')"><?php echo $info['description']?></textarea>
									</div>
								</div>							 
							<br><br>
							
							<div class="row">
							</div>
							<div class="row">
								<div class="col-sm-4"> 
									<label for="vendor_name" class="form-control-label" id="vendor_name_lbl">Vendor Name</label>
								</div>
								<div class="col-sm-2"> 
									<label for="price" class="form-control-label" id="price_lbl">Vendor Part (SKU Code)</label>
								</div>
								<div class="col-sm-2"> 
									<label for="price" class="form-control-label" id="price_lbl">Price in Unit</label>
								</div>
								<div class="col-sm-2"> 
									<label for="price" class="form-control-label" id="price_lbl">Action</label>
								</div>
							</div>
							<?php
							for($l=0; $l < sizeof($vendor_info); $l++)
							{	?>
								<div class="row">
									<div class="col-sm-4">								
										<select class="form-control basic-single" id="update_vendor" name="update_vendor[]" onchange="change_status('update_vendor_div')"/>
											<option selected  value="">Select Vendor</option>
											<?php
												if(sizeof($vendor))
												{
													for($r=0; $r < sizeof($vendor);$r++)
													{ ?>
															<option 
															<?php	
															if($vendor[$r]['vendor_id'] == $vendor_info[$l]['vendor_id'])
															{
																echo"selected";
															}?>
															value="<?php echo $vendor[$r]['vendor_id'];?>" ><?php echo $vendor[$r]['vendor_name']; ?></option>
														<?php
													}
												}
											?>
										</select>
									</div>
									<div class="col-sm-2">
									<div class="form-group update_sku_code_div">
										<input type="text" class="form-control update_sku_code" id="supdate_ku_code" name="update_sku_code[]" placeholder="SKU Code" value="<?php echo $vendor_info[$l]['sku_code']; ?>" onkeyup="change_status('update_sku_code_div')"/>
									</div>
								</div>
									<div class="col-sm-2">
										<input type="text" class="form-control" id="update_price<?php echo $l; ?>" name="update_price[]" placeholder="Price" onkeyup="change_status('update_price_div'),intfloat('update_price<?php echo $l; ?>')" value="<?php echo $vendor_info[$l]['price']?>"/>
									</div>
									<input type="hidden" name="update_product_id[]" value="<?php echo $vendor_info[$l]['id']?>" >
									<div class="col-sm-2">
										<select class="form-control" id="update_action" name="update_action[]" onchange="change_status('update_action_div')">
											<option selected value="update">Update</option>
											<option value="delete">Delete</option>
										</select>
									</div>
									<div class="col-sm-2">
										<a href="<?php echo base_url("account/po/add?vendor=").$vendor_info[$l]['vendor_id'].'&pro='.$info['product_id']?>" >PO</a>
									</div>
								</div><br>							
								<?php 
							}
							?>
							
							
							
							
							 
														
							<div class="row tessttst" id="tessttst">
								<div class="row">
									<div id="row_id_1">
										<div class="col-sm-4">
											<div class="form-group vendor_sele_div">
												<select class="form-control basic-single vendors" id="vendor" name="vendor[]" onchange="change_status('vendor_sele_div')"  data-srno="0" updateToBox="0"/>
													<option selected value="">Select Vendor</option>
													<?php
														if(sizeof($vendor))
														{
															for($i=0;$i<sizeof($vendor);$i++)
															{
																?>
																	<option value="<?php echo $vendor[$i]['vendor_id']; ?>"><?php echo $vendor[$i]['vendor_name']; ?></option>
																<?php
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group sku_code_div">
												<input type="text" class="form-control sku_code" id="sku_code" name="sku_code[]" placeholder="SKU Code" onkeyup="change_status('sku_code_div')"/>
											</div>
										</div>
										
										<div class="col-sm-2">
											<div class="form-group price_div">
												<input type="text" class="form-control price" id="price" name="price[]" placeholder="Price" onkeyup="change_status('price_div',integer('price'))"/>
											</div>
										</div>
										
										<div class="col-sm-1" id = "add_div" >
											<a class="btn btn-success btn-top add" id="add_row">Add</a>
										</div>
										<div class="col-sm-2" id="totalprice0" data-srno="1"> </div>
									</div>
								</div>
							</div>
							
							<input type="hidden" id="product_id" name="product_id" value="<?php echo $info['product_id'];?>">
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<button type="submit" class="btn btn-base pull-left">Update Product</button>
										<a href="<?php echo base_url("account/product/index") ?>">
											<button type="button" style="margin-left:10px !important;" class="btn btn-warning pull-left" name="add_aggrement"><< Cancel</button>
										</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>		
		</div>		
	</div> 
</div>
<script>
	$("#pro_sub_category").change(function()
	{
		var sub_catID=$(this).val();
		if(sub_catID)
		{
			document.location="<?php echo base_url("account/product/manage?id=")?>"+<?php echo $info['product_id']; ?>+'&sub_cat='+sub_catID;
		}
		else
		{
			document.location="<?php echo base_url("account/product/manage?id=")?>"+<?php echo $info['product_id']; ?>;
		}
	});

	// get the sub cst details on change of cat..
	$(document).on("change","#pro_category",function()
	{
		//var team_id=$("#team_set").val();
		var category_id=$("#pro_category").val();
		if(category_id)
		{
			$.ajax({url:"<?php echo base_url("account/product/get_sub_category"); ?>",method:"POST",data:{
				category_id:category_id
			},
			success:function(a)
			{
				$("#pro_sub_category").html(a);
			}});
		}
	});
	
	$(document).ready(function()
	{
		var count = 1;
		$(document).on('click', '#add_row', function()
		{
			++count;				
			var html_code = '<div class="row"><div id="row_id_'+count+'"><div class="col-sm-4"><div class="form-group vendor_sele_div"><select class="form-control basic-single vendors" id="vendor" name="vendor[]" onchange="change_status("vendor_sele_div")" data-srno="'+count+'" updateToBox="'+count+'"><option selected value="">Select Vendor</option><?php if(sizeof($vendor)){ for($i=0;$i<sizeof($vendor);$i++){ ?> <option value="<?php echo $vendor[$i]["vendor_id"]; ?>"><?php echo $vendor[$i]["vendor_name"]; ?></option> <?php } } ?></select> </div> </div> <div class="col-sm-2"> <div class="form-group sku_code_div"> <input type="text" class="form-control sku_code" id="sku_code" name="sku_code[]" placeholder="SKU Code" onkeyup="change_status("sku_code_div")"> </div> </div><div class="col-sm-2"><div class="form-group price_div"><input type="text" class="form-control price" id="price" name="price[]" placeholder="Price" onkeyup="change_status("price_div",integer("price"))"/> </div> </div> <div class="col-sm-1" id = "add_div" > <a class="btn btn-danger btn-top remove">Remove</a> </div> <div class="col-sm-2" id="totalprice'+count+'" data-srno="1"> </div></div></div>';
			$('#tessttst').append(html_code);
		});
	});

	$(document).on('change', '.vendors', function()
	{	
		var testst = $(this).val();
		var updateToBox = $(this).attr('updateToBox');
		var product_id= $('#product_id').val();
		if(testst)
		{
			var link = "<?php echo base_url("account/po/add?vendor=")?>"+testst+'&pro='+product_id;
			$("#totalprice"+updateToBox).html('<a href="'+link+'">PO</a>');			 
		}
	});
	
 </script>
<script>
	function change_status(div)
	{
		$("."+div).removeClass("has-danger");
	}
	
	$("#frm").submit(function(e)
	{
		var flag="True";
		var hsn_code = $("#hsn_code").val();		
		var storage_type = $("#storage_type").val();
		var product_name = $("#product_name").val();
		var uom = $("#uom").val();
		
		if(hsn_code=="")
		{
			$(".hsn_code_div").addClass("has-danger");
			flag="False";
		}
		if(storage_type=="" || storage_type== null)
		{
			$(".storage_type_div").addClass("has-danger");
			flag="False";
		}
		if(product_name=="")
		{
			$(".product_name_div").addClass("has-danger");
			flag="False";
		}
		if(uom=="")
		{
			$(".uom_div").addClass("has-danger");
			flag="False";
		}	

		if(flag=="False")
		{
			e.preventDefault();
			return false;
		}

	});

	  
</script>	  