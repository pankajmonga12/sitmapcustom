<html>
	<head>
		<title>Import CSV</title>
	</head>
	<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	error_reporting(-1);
	ini_set("display_errors", 1);
	
	$dataView['msg'] = "";
	if(isset($_POST['submit']))
	{
		$serverName = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com';
		$serverUserName = 'bnbuser';
		$serverUserNamePassword = '1234567890';
		/*$serverName = 'localhost';
		$serverUserName = 'root';
		$serverUserNamePassword = '';*/
		$serverDatabase = 'bnbdb';
		$dbConn = mysql_connect($serverName, $serverUserName, $serverUserNamePassword);
		mysql_select_db($serverDatabase, $dbConn);
		$filename = $_FILES['files']['name'];
		print "<p> Filename: ".$filename."</p>";
		$filename = "assets/uploads/".$filename;
		print "<p> Filename: ".$filename."</p>";
		move_uploaded_file($_FILES['files']['tmp_name'],$filename);
		$handle = fopen($filename, "r+");
		print "<pRE>\$handle = ".print_r($handle, TRUE)."</pRE>";
		print "<p>Reading file contents just to verify</p>";
		echo "<pre>", file_get_contents($filename), "</pre>";
		$data = NULL;
		$data = fgetcsv($handle, 0, ",");    //Remove Ist column headings
		$data = fgetcsv($handle, 0, ",");   //  Remove IInd column headings

		print "<p>going to enter loop now</p>";

		while (($data = fgetcsv($handle, 0, ",")) !== FALSE)
		{
			print "<p>Entered Data Loop now</p>";
			echo "<pre> \r\n\$data = ", print_r($data, TRUE), "\r\n<hr>\r\n</pre>";
			$Sno = mysql_real_escape_string($data[0], $dbConn);
			$Pimg = mysql_real_escape_string($data[1], $dbConn);
			$VProdcode = mysql_real_escape_string($data[2], $dbConn);
			$Bnbprodcode = mysql_real_escape_string($data[3], $dbConn);
			$category = mysql_real_escape_string($data[4], $dbConn);
			$subCategory1 = mysql_real_escape_string($data[5], $dbConn);
			$subCategory2 = mysql_real_escape_string($data[6], $dbConn);
			$subCategory3 = mysql_real_escape_string($data[7], $dbConn);
			$storeSection = mysql_real_escape_string($data[8], $dbConn);
			$storeId = mysql_real_escape_string($data[9], $dbConn);
			$product = mysql_real_escape_string($data[10], $dbConn);
			$prodCreatWrite = mysql_real_escape_string($data[11], $dbConn);
			$color = mysql_real_escape_string($data[12], $dbConn);
			$finish = mysql_real_escape_string($data[13], $dbConn);
			$size = mysql_real_escape_string($data[14], $dbConn);
			$techSpec = mysql_real_escape_string($data[15], $dbConn);
			$materialComp = mysql_real_escape_string($data[16], $dbConn);
			$totalPiece = mysql_real_escape_string($data[17], $dbConn);
			$tags = mysql_real_escape_string($data[18], $dbConn);
			$occasion = mysql_real_escape_string($data[19], $dbConn);
			$styles = mysql_real_escape_string($data[20], $dbConn);
			$prd1DimensionLabel = mysql_real_escape_string($data[21], $dbConn);
			$prd1Length = mysql_real_escape_string($data[22], $dbConn);
			$prd1Width = mysql_real_escape_string($data[23], $dbConn);
			$prd1height = mysql_real_escape_string($data[24], $dbConn);
			$prd1capacity = mysql_real_escape_string($data[25], $dbConn);
			$prd1diameter = mysql_real_escape_string($data[26], $dbConn);
			$prd1unit = mysql_real_escape_string($data[27], $dbConn);
			$prd2DimensionLabel = mysql_real_escape_string($data[28], $dbConn);
			$prd2Length = mysql_real_escape_string($data[29], $dbConn);
			$prd2Width = mysql_real_escape_string($data[30], $dbConn);
			$prd2height = mysql_real_escape_string($data[31], $dbConn);
			$prd2capacity = mysql_real_escape_string($data[32], $dbConn);
			$prd2diameter = mysql_real_escape_string($data[33], $dbConn);
			$prd2unit = mysql_real_escape_string($data[34], $dbConn);
			$prd3DimensionLabel = mysql_real_escape_string($data[35], $dbConn);
			$prd3Length = mysql_real_escape_string($data[36], $dbConn);
			$prd3Width = mysql_real_escape_string($data[37], $dbConn);
			$prd3height = mysql_real_escape_string($data[38], $dbConn);
			$prd3capacity = mysql_real_escape_string($data[39], $dbConn);
			$prd3diameter = mysql_real_escape_string($data[40], $dbConn);
			$prd3unit = mysql_real_escape_string($data[41], $dbConn);
			$weight = mysql_real_escape_string($data[42], $dbConn);
			$whatsInBox = mysql_real_escape_string($data[43], $dbConn);
			$usage = mysql_real_escape_string($data[44], $dbConn);
			$careQcIns = mysql_real_escape_string($data[45], $dbConn);	
			$assembly = mysql_real_escape_string($data[46], $dbConn);
			$sellerAssurance = mysql_real_escape_string($data[47], $dbConn);
			$additionalInfo = mysql_real_escape_string($data[48], $dbConn);
			$deliveryTime = mysql_real_escape_string($data[49], $dbConn);
			$price = mysql_real_escape_string($data[50], $dbConn);
			$cartonlength = mysql_real_escape_string($data[51], $dbConn);
			$cartonwidth = mysql_real_escape_string($data[52], $dbConn);
			$cartonheight = mysql_real_escape_string($data[53], $dbConn);
			$actualWeight = mysql_real_escape_string($data[54], $dbConn);
			$volWeCal = mysql_real_escape_string($data[55], $dbConn);
			$prefMode = mysql_real_escape_string($data[56], $dbConn);
			$moneyin = mysql_real_escape_string($data[57], $dbConn);
			$bnbComm = mysql_real_escape_string($data[58], $dbConn);
			$taxRate = mysql_real_escape_string($data[59], $dbConn);
			$taxThis = mysql_real_escape_string($data[60], $dbConn);
			$insurance = mysql_real_escape_string($data[61], $dbConn);
			$shippingCost = mysql_real_escape_string($data[62], $dbConn);
			$mrp = mysql_real_escape_string($data[63], $dbConn);
			$discountMrp = mysql_real_escape_string($data[64], $dbConn);
			$discountValue = mysql_real_escape_string($data[65], $dbConn);
			$sellingPrice = mysql_real_escape_string($data[66], $dbConn);
			$quantity = mysql_real_escape_string($data[67], $dbConn);
			$processingTime = mysql_real_escape_string($data[68], $dbConn);
			/* HACK BY SHAMMI SHAILAJ
			   TO TACKLE ISSUE WHERE A STORESECTION ID IS CREATED WHEN THE SHEET IS FILLED WITH THE STORESECTION_ID FROM DB
			   INSTEAD OF ITS NAME. THIS HACK WILL RUN A DB QUERY AND STORE ITS NAME WHEN AN INTEGER IS ENCOUNTERED IN $storeSection
			*/
			 echo "<p>\$storeSection = ".$storeSection." ";
			if( is_numeric($storeSection) )
			{
				echo "is numeric!! Hack in progress...</p>";
				$storeSectionHackQuery = "SELECT `storesection_id`, `store_id`, `name` FROM store_section WHERE(`store_id` = ".$storeId." AND `storesection_id` = ".$storeSection.")";
				$storeSectionHackQ = mysql_query($storeSectionHackQuery, $dbConn) or die("<pre> Failed Executing query ========================\r\n".$storeSectionHackQuery."\r\n=====================</pre>");
				switch(mysql_num_rows($storeSectionHackQ) > 0)
				{
					case TRUE: $storeSectionHackResult = mysql_fetch_object($storeSectionHackQ);
								$storeSection = $storeSectionHackResult->name;
						break;
				}
			}
			else
			{
				echo " is not a number. Won't hack. :) </p>";	
			}
			/*
			END SECTION HACK BY SHAMMI SHAILAJ
			*/

			if($Sno!="")
			{
				$section="";
				$sqlFetchStoreQuery = mysql_query("select * from store_section where store_id='".$storeId."' and name='".$storeSection."'", $dbConn) or die("<pre> Failed Executing query ========================\r\n"."select * from store_section where store_id='".$storeId."' and name='".$storeSection."'"."\r\n=====================</pre>");
				$sqlFetchStore = mysql_fetch_array($sqlFetchStoreQuery);
				$section = $sqlFetchStore['0'];
				$sectionStoreId = $sqlFetchStore['1'];
				$sectionName = $sqlFetchStore['2'];
				if($sectionStoreId != $storeId && $sectionName != $storeSection)
				{
					$sqlStoresection="insert into store_section(store_id,name,is_on_discount,promotion_id) values('".$storeId."','".$storeSection."',0,0)";
					$resultStoresection=mysql_query($sqlStoresection, $dbConn);
					if(!$resultStoresection)
					{
						die('<p>db query: '.$sqlStoresection.'</p><p>Invalid query: ' . mysql_error()."</p>");
						print "<pre> Failed Executing query ========================\r\n".$sqlStoresection."\r\n=====================</pre>";
					}
					$storeSectionIdQuery = mysql_query("SELECT MAX(storesection_id) FROM store_section", $dbConn) or die("<pre> Failed Executing query ========================\r\n"."SELECT MAX(storesection_id) FROM store_section"."\r\n=====================</pre>");
					$storeSectionId = mysql_fetch_array($storeSectionIdQuery);
					$section = $storeSectionId['0']; 
				}
				if($discountValue > 0)
				{
					$sqlpromotion=mysql_query("insert into promotion(store_id,discount_on_type,promotion_type,discount,expiry_type,status) values ('".$storeId."',1,0,'".$discountValue."',0,1)", $dbConn) or die("<pre> Failed Executing query ========================\r\n"."insert into promotion(store_id,discount_on_type,promotion_type,discount,expiry_type,status) values ('".$storeId."',1,0,'".$discountValue."',0,1)"."\r\n=====================</pre>");
					$sqlfetchPromotionQuery = mysql_query("select max(id) from promotion", $dbConn) or die("<pre> Executing query ========================\r\n"."select max(id) from promotion"."\r\n=====================</pre>");
					$sqlfetchPromotion=mysql_fetch_array($sqlfetchPromotionQuery);
					$promotionId=$sqlfetchPromotion['0'];
					$sqlProductsNew = "INSERT INTO productsNew(store_id, cat_id, sub_catid1, sub_catid2, sub_catid3, product_name, prd_act_weight, tax_rate, insurance_cost, shipping_cost, selling_price, quantity, processing_time, discount, discount_percent, prd_vol_weight, shipping_mode, bnb_commission, bnb_product_code, storesection_id) ";
					$sqlProductsNew .= "VALUES ('".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$weight."','".$taxRate."','".$insurance."','".$shippingCost."','".$mrp."','".$quantity."','".$processingTime."','".$discountValue."','".$discountMrp."','".$volWeCal."','".$prefMode."','".$bnbComm."','".$Bnbprodcode."','".$section."')";

					$sqlProductsNew = "INSERT INTO productsNew(store_id, cat_id, sub_catid1, sub_catid2, sub_catid3, product_name, prd_act_weight, tax_rate, insurance_cost, shipping_cost, selling_price, quantity, processing_time, discount, discount_percent, is_on_discount, prd_vol_weight, shipping_mode, seller_earnings, bnb_commission, promotion_id, bnb_product_code, storesection_id) ";
					$sqlProductsNew .= "VALUES ('".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$weight."','".$taxRate."','".$insurance."','".$shippingCost."','".$mrp."','".$quantity."','".$processingTime."','".$discountValue."','".$discountMrp."',".($discountValue > 0? 1 : 0).",'".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."','".$promotionId."','".$Bnbprodcode."','".$section."')";

					$result = mysql_query($sqlProductsNew, $dbConn);
					$sqlfetchProductQuery = mysql_query("select max(product_id) from productsNew", $dbConn) or die("<pre> Failed Executing query ========================\r\nselect max(product_id) from productsNew\r\n=====================</pre>");
					$sqlfetchProduct = mysql_fetch_array($sqlfetchProductQuery);
					
					$oldProdId = $sqlfetchProduct['0'];
					$sqloldProducts = "insert into products(product_id,store_id,cat_id,sub_catid1,sub_catid2,sub_catid3,product_name,bnb_product_code,storesection_id,occasions,style,tags,length,breadth,height,prd_act_weight,prd_vol_weight,shipping_mode,seller_earnings,bnb_commission,tax_rate,insurance_cost,shipping_cost,selling_price,quantity,processing_time,status,discount,is_on_discount,promotion_id) values('".$oldProdId."',
					'".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$Bnbprodcode."','".$section."','".$occasion."','".$styles."','".$tags."','".$prd1Length."','".$prd1Width."','".$prd1height."','".$weight."','".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."','".$taxRate."','".$insurance."','".$shippingCost."','".$mrp."','".$quantity."','".$processingTime."',1,'".$discountValue."',1,'".$promotionId."')";
					$resultold = mysql_query($sqloldProducts, $dbConn);
					if(!$resultold)
					{
						print "<pre> Failed Executing query ========================\r\n".$sqloldProducts."\r\n=====================</pre>";
						die('Invalid query: ' . mysql_error());
					}


					if(!$result)
					{
						print "<pre> Failed Executing query ========================\r\n".$sqlProductsNew."\r\n=====================</pre>";
						die('Invalid query: ' . mysql_error());
					}
				}
				else
				{
					$sqlProductsNew1 = "INSERT INTO productsNew(store_id,cat_id,sub_catid1,sub_catid2,sub_catid3,product_name,prd_act_weight,tax_rate,insurance_cost,shipping_cost,selling_price,quantity,processing_time,discount,discount_percent,is_on_discount,prd_vol_weight,shipping_mode,seller_earnings,bnb_commission,promotion_id,bnb_product_code,storesection_id) VALUES ('".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."',
					'".$weight."','".$taxRate."','".$insurance."','".$shippingCost."','".$mrp."','".$quantity."','".$processingTime."','".$discountValue."','".$discountMrp."',0,'".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."',0,'".$Bnbprodcode."','".$section."')";

					$result = mysql_query($sqlProductsNew1, $dbConn) or die("<pre> Failed Executing query ========================\r\n".$sqlProductsNew1."\r\n=====================</pre>");
					$sqlfetchProduct1Query = mysql_query("select max(product_id) from productsNew", $dbConn) or die("<pre> Executing query ========================\r\n"."select max(product_id) from productsNew"."\r\n=====================</pre>");
					$sqlfetchProduct1 = mysql_fetch_array($sqlfetchProduct1Query);
					$oldProdId1 = $sqlfetchProduct1['0'];
					$sqloldProducts1 = "insert into products(product_id,store_id,cat_id,sub_catid1,sub_catid2,sub_catid3,product_name,bnb_product_code,storesection_id,occasions,style,tags,length,breadth,height,prd_act_weight,prd_vol_weight,shipping_mode,seller_earnings,bnb_commission,tax_rate,insurance_cost,shipping_cost,selling_price,quantity,processing_time,status,discount,is_on_discount,promotion_id) values('".$oldProdId1."',
					'".$storeId."','".$category."','".$subCategory1."','".$subCategory2."','".$subCategory3."','".$product."','".$Bnbprodcode."','".$section."','".$occasion."','".$styles."','".$tags."','".$prd1Length."','".$prd1Width."','".$prd1height."','".$weight."','".$volWeCal."','".$prefMode."','".$moneyin."','".$bnbComm."','".$taxRate."','".$insurance."','".$shippingCost."','".$mrp."','".$quantity."','".$processingTime."',1,'".$discountValue."',0,0)";

					mysql_query($sqloldProducts1, $dbConn) or die("<pre> Failed Executing query ========================\r\n".$sqloldProducts1."\r\n=====================</pre>");
				}
				$productsIdQuery = mysql_query("SELECT MAX(product_id) FROM productsNew", $dbConn) or die("<pre> Failed Executing query ========================\r\n"."SELECT MAX(product_id) FROM productsNew"."\r\n=====================</pre>");
				$productId = mysql_fetch_array($productsIdQuery);
				$product = $productId['0'];
				$sqlPDesc = "insert into pDesc(refProductID,description,occasions,style,tags,vendor_product_code,finish,tech_spec,material_composition,whats_in_the_box,care,assembly,seller_assurance,additional_info,cartonLength,cartonBreadth,cartonHeight,packageWeight,`usage`) values ('".$product."','".$prodCreatWrite."',
				'".$occasion."','".$styles."','".$tags."','".$VProdcode."','".$finish."','".$techSpec."','".$materialComp."','".$whatsInBox."','".$careQcIns."','".$assembly."','".$sellerAssurance."','".$additionalInfo."','".$cartonlength."','".$cartonwidth."','".$cartonheight."','".$actualWeight."','".$usage."')";

				$res = mysql_query($sqlPDesc, $dbConn);
				if(!$res)
				{
					die('Invalid query: ' . mysql_error());
					print "<pre> Failed Executing query ========================\r\n".$sqlPDesc."\r\n=====================</pre>";
				}
				if($prd1Length != "" || $prd1Width != "" || $prd1height != "" || $prd1unit != "" || $prd1capacity != "" || $prd1diameter != "" || $prd1DimensionLabel != "")
				{
					$newUnit="";
					if($prd1unit == 'cms' || $prd1unit == 'cm')
					{
						$newUnit = 2;
					}
					elseif($prd1unit == 'inch' || $prd1unit == 'inches')
					{
						$newUnit = 1;
					}
					elseif($prd1unit == 'mm')
					{
					    $newUnit = 3;
					}
					elseif($prd1unit == 'ml')
					{
						$newUnit = 4;
					}
					elseif($prd1unit == 'l' || $prd1unit == 'liter' || $prd1unit == 'litre')
					{
						$newUnit = 5;
					}
					elseif($prd1unit =='feet' || $prd1unit == 'feets')
					{
						$newUnit = 6;
					}
					
					$sqlpDims = "insert into pDims(refProductID,length,breadth,height,dimensionUnit,capacity,diameter,dimensionLabel) values('".$product."','".$prd1Length."','".$prd1Width."','".$prd1height."','".$newUnit."','".$prd1capacity."','".$prd1diameter."','".$prd1DimensionLabel."')";

					mysql_query($sqlpDims, $dbConn) or die("<pre> Failed Executing query ========================\r\n".$sqlpDims."\r\n=====================</pre>");
					if($prd2Length != "" || $prd2Width != "" || $prd2height != "" || $prd2unit != "" || $prd2capacity != "" || $prd2diameter != "" || $prd2DimensionLabel != "")
					{
						$newUnit1 = "";
						if($prd2unit == 'cms' || $prd2unit == 'cm')
						{
							$newUnit1 = 2;
						}
						elseif($prd2unit == 'inch' || $prd2unit == 'inches')
						{
							$newUnit1 = 1;
						}
						elseif($prd2unit == 'mm')
						{
						    $newUnit1 = 3;
						}
						elseif($prd2unit == 'ml')
						{
							$newUnit1 = 4;
						}
						elseif($prd2unit == 'l' || $prd2unit == 'liter' || $prd2unit == 'litre')
						{
							$newUnit1 = 5;
						}
						elseif($prd2unit == 'feet' || $prd2unit == 'feets')
						{
							$newUnit = 6;
						}
						
						$sqlpDims1 = "insert into pDims(refProductID,length,breadth,height,dimensionUnit,capacity,diameter,dimensionLabel) values('".$product."','".$prd2Length."','".$prd2Width."','".$prd2height."','".$newUnit1."','".$prd2capacity."','".$prd2diameter."','".$prd2DimensionLabel."')";

						mysql_query($sqlpDims1, $dbConn) or die("<pre> Failed Executing query ========================\r\n".$sqlpDims1."\r\n=====================</pre>");
					}
					if($prd3Length != "" || $prd3Width != "" || $prd3height != "" || $prd3unit != "" || $prd3capacity != "" || $prd3diameter != "" || $prd3DimensionLabel != "")
					{
						$newUnit2 = "";

						if($prd3unit == 'cms' || $prd3unit == 'cm')
						{
							$newUnit2 = 2;
						}
						elseif($prd3unit == 'inch' || $prd3unit == 'inches')
						{
							$newUnit2 = 1;
						}
						elseif($prd3unit == 'mm')
						{
							$newUnit2 = 3;
						}
						elseif($prd3unit == 'ml')
						{
							$newUnit2 = 4;
						}
						elseif($prd3unit == 'l' || $prd3unit == 'liter' || $prd3unit == 'litre')
						{
							$newUnit2 = 5;
						}
						elseif($prd3unit == 'feet' || $prd3unit == 'feets')
						{
							$newUnit = 6;
						}
						/*if($prd3unit=='cms')
						{
							$newUnit2 = 2;
						}
						elseif($prd3unit=='inch')
						{
							$newUnit2 = 1;
						}
						elseif($prd3unit=='mm')
						{
							$newUnit2 = 3;
						}*/
						$sqlpDims2 = "insert into pDims(refProductID,length,breadth,height,dimensionUnit,capacity,diameter,dimensionLabel) values('".$product."','".$prd3Length."','".$prd3Width."','".$prd3height."','".$newUnit2."','".$prd3capacity."','".$prd3diameter."','".$prd3DimensionLabel."')";

						mysql_query($sqlpDims2, $dbConn) or die("<pre> Failed Executing query ========================\r\n".$sqlpDims2."\r\n=====================</pre>");
					}
				}
			}
		}
		$dataView['msg'] = "Product Data Importing code Ended execution cycle!! If you are seeing this message before the execution went into the loop then something went wrong.\r\nvalue of expression: (\$data = fgetcsv(\$handle, 0, \",\")) = ".json_encode(($data = fgetcsv($handle, 0, ",")))."\r\n\$data = ".print_r($data, TRUE);
	}
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="top">
                <table width="100%" border="0">
                    <tr>
                        <td height="25" align="center" class="label">Import Csv</td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="3" cellspacing="0">
                    <tr>
                        <td valign="top">
                            <form action="" name="" method="POST" enctype="multipart/form-data">
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%" class="line2">File Name:</td>
                                        <td width="70%" align="left" class="line2">
                                        	<input type="file" name="files" id="files">
                                        </td>
                                        <td>
                                        	<input name="submit" type="submit" class="buttons" value="Submit" >
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="left" valign="middle" class="line2">&nbsp;<?php echo "<pre>".$dataView['msg']."</pre>";?></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
	</body>
</html>
