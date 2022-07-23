<!DOCTYPE html>
<html>
	<head>
		<title>Stoct In Report</title>
	</head>
	<style>
		body{
			font-size: 12px;
		}

	
		.header_table {
			/*background-color: black;*/
			width: 100%;
		}
		.header_title {
		     font-weight: normal;
		     text-align: right;
		     background-color: white;
		     width: 12%;
		     vertical-align: text-top;
		}
		.header_body {
		     font-weight: normal;
		     text-align: left;
		     background-color: white;
		     width: 25%;
		     vertical-align: text-top;
		}
		.table{
			background-color: black;
			width: 100%;
		}
		.header{
			background-color: #efe8e8;
			text-align: center;
		}
		.body{
			background-color: white;
			vertical-align: text-top;
		}
		.body_center{
			background-color: white;
			text-align: center;
			vertical-align: text-top;
		}
		.body_right{
			background-color: white;
			text-align: right;
			vertical-align: text-top;
		}
		.footer_center{
			background-color: #efe8e8;
			text-align: center;
			font-weight: bold;
			vertical-align: text-top;
		}
		.footer_right{
			background-color: #efe8e8;
			text-align: right;
			font-weight: bold;
			vertical-align: text-top;
		}
		.width_table{
			width: 10%;
		}
	</style>
	<body>
		<p style='font-size:18px;font-weight:bold;text-align:Center'>Stoct Out Report</p>
		<table align='center' class="table">
			<thead align="left" style="display: table-header-group">
				<tr>
					<th class="header">No</th>
                    <th class="header" width="150px">Date</th>
                    <th class="header">Shop</th>
                    <th class="header">Product Type</th>
                    <th class="header">Size</th>
                    <th class="header">Color</th>
                    <th class="header">Imei</th>
                    <th class="header">Create</th>
                    <th class="header">Warehouse</th>
				</tr>
			</thead>
			<?php
				$no = 1;
				foreach ($data as $row){
					echo "<tr>";
						echo "<td class='body_center'>".$no."</td>";
						echo "<td class='body'>".$row->create_at."</td>";
						echo "<td class='body'>".$row->m_shop_name."</td>";
						echo "<td class='body'>".$row->m_product_type_name."</td>";
						echo "<td class='body'>".$row->m_size_name."</td>";
						echo "<td class='body'>".$row->m_color_name."</td>";
						echo "<td class='body'>".$row->t_imei_number."</td>";
						echo "<td class='body'>".$row->m_employee_full_name."</td>";
						echo "<td class='body'>".$row->m_warehouse_name."</td>";
					echo "</tr>";
					$no++;
				}
			?>
		</table>
	</body>
</html>