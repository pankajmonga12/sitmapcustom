<?php
header("Content-Type: application/atom+xml; charset=utf-8");
$data = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
$data .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' .PHP_EOL;

$dbhost = 'myolddbtemp.c4xniebqwpch.ap-southeast-1.rds.amazonaws.com';
$dbuser = 'bnbuser';
$dbpass = '34d04b8745abd3ef7ea88d9ac0637e64';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

/* $base_url = "http://buynbrag.com/#!/"; */
$base_url = "https://buynbrag.com/";
$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
$today_date =Date('Y-m-d ',$yesterday);

if(! $conn )
{
    die('Could not connect: ' . mysqli_error());
}

$store_query ='SELECT store_name,store_id FROM store_info WHERE isPublished=1 ';
$product_query = 'SELECT product_name,product_id FROM products WHERE `status`=1 AND `is_enable`=0';
$catagory_query = 'SELECT category_name, category_id FROM catagories WHERE `status`=1 AND `parent_catagory_id`= 0';

$sub_catagory_query ="SELECT distinct parent.category_name AS parent_catagory, child.category_name as child_catagory,child.category_id as child_id, parent.status as child_status
FROM catagories As parent
LEFT JOIN catagories AS child ON child.parent_catagory_id = parent.category_id
WHERE parent.category_name IN ( 'Fashion', 'Art','Gifts & Collectibles','Furniture','Dining','Decor and Furnishings','Lighting') AND child.status = 1 && child.category_name IS NOT NULL ";

$sub_sub_catagory_query ="SELECT distinct parent.category_name AS parent_catagory, child.category_name as child_catagory,sub_child.category_name as sub_child_catagory,sub_child.category_id as sub_child_id, sub_child.status as sub_child_status,sub_child.category_id
FROM catagories As parent
LEFT JOIN catagories AS child ON child.parent_catagory_id = parent.category_id
LEFT JOIN catagories AS sub_child ON sub_child.parent_catagory_id = child.category_id
WHERE parent.category_name IN ( 'Fashion', 'Art','Gifts & Collectibles','Furniture','Dining','Decor and Furnishings','Lighting') && sub_child.status = 1 && sub_child.category_name IS NOT NULL  ";

$sub_sub_sub_catagory_query ="SELECT distinct parent.category_name AS parent_catagory, child.category_name as child_catagory,sub_child.category_name as sub_child_catagory,sub_sub_child.category_name as sub_sub_child_catagory,sub_sub_child.category_id as sub_sub_child_id, sub_sub_child.status as sub_child_status,sub_sub_child.category_id
FROM catagories As parent
LEFT JOIN catagories AS child ON child.parent_catagory_id = parent.category_id
LEFT JOIN catagories AS sub_child ON sub_child.parent_catagory_id = child.category_id
LEFT JOIN catagories AS sub_sub_child ON sub_sub_child.parent_catagory_id = sub_child.category_id
WHERE parent.category_name IN ( 'Fashion', 'Art','Gifts & Collectibles','Furniture','Dining','Decor and Furnishings','Lighting') && sub_sub_child.status = 1 && sub_sub_child.category_name IS NOT NULL  ";

mysqli_select_db($conn, 'bnbdb');
$store_retval = mysqli_query($conn, $store_query);
$product_retval = mysqli_query( $conn, $product_query);
$catagory_retval = mysqli_query( $conn, $catagory_query );
$sub_catagory_retval = mysqli_query( $conn, $sub_catagory_query );
$sub_sub_catagory_retval = mysqli_query( $conn, $sub_sub_catagory_query );
$sub_sub_sub_catagory_retval = mysqli_query($conn, $sub_sub_sub_catagory_query );


$urlarray = array();
$urlarray[] = '/allStores';
$urlarray[] = '/trends/New-Delhi';
$urlarray[] = '/trends/Mumbai';
$urlarray[] = '/trends/Hyderabad';
$urlarray[] = '/trends/Kolkata';
$urlarray[] = '/trends/Bengaluru';

$urlarray[] = '/contact';
$urlarray[] = '/aboutUs';
$urlarray[] = '/policies';
$urlarray[] = '/Sellers';

function urlElement($url,$date,$p)
{
    $data = '<url>'.PHP_EOL;
    $data .= '<loc>'.$url.'</loc>'. PHP_EOL;
    $data .='<changefreq>weekly</changefreq>'.PHP_EOL;
    $data .= '<priority>'.$p.'</priority>'.PHP_EOL;
    $data .= '<lastmod>'.$date.'</lastmod>'.PHP_EOL;
    $data .= '</url>'.PHP_EOL;
    return $data;
}

$data .= urlElement($base_url,$today_date,'1.0');

$data .= urlElement( $base_url.'allStores',$today_date,'0.9');
$data .= urlElement( $base_url.'trends/New-Delhi',$today_date,'0.9');
$data .= urlElement( $base_url.'trends/Mumbai',$today_date,'0.9');
$data .= urlElement( $base_url.'trends/Hyderabad',$today_date,'0.9');
$data .=urlElement( $base_url.'trends/Kolkata',$today_date,'0.9');
$data .=urlElement( $base_url.'trends/Bengaluru',$today_date,'0.9');

$data .=urlElement( $base_url.'contact',$today_date,'0.8');
$data .=urlElement( $base_url.'aboutUs',$today_date,'0.8');
$data .=urlElement( $base_url.'policies',$today_date,'0.8');
$data .= urlElement( $base_url.'Sellers',$today_date,'0.8');

function nameBeautify($string) {
    return preg_replace('/\s+/', '-', trim(preg_replace('/\W/', ' ', $string)));
}

function nameCollapse($string) {
    return trim(preg_replace('/\W/', '', $string));
}

while($product = mysqli_fetch_array($product_retval, MYSQL_ASSOC) )
{
    $product_name = $product['product_name'];
    $finalUrl = $base_url.'product/'.nameBeautify($product_name).'/'.$product['product_id'];
    $data .= urlElement($finalUrl,$today_date,'0.7');
    $urlarray[] =$finalUrl;
}

while($store = mysqli_fetch_array($store_retval, MYSQL_ASSOC) )
{
    $store_name = $store['store_name'];
    $finalUrl = $base_url.'store'.'/'.nameBeautify($store_name).'/'.$store['store_id'];
    $data .= urlElement ($finalUrl, $today_date,'0.6');
    $urlarray[] =$finalUrl;
}

while ( $catagory = mysqli_fetch_array($catagory_retval, MYSQL_ASSOC ))
{
    $catagory_name = $catagory['category_name'];
    $finalUrl = $base_url.nameBeautify($catagory_name).'/'.$catagory['category_id'];
    $data .= urlElement($finalUrl, $today_date,'0.5');
    $urlarray[] =$finalUrl;
}

while ( $sub_catagory = mysqli_fetch_array($sub_catagory_retval, MYSQL_ASSOC ))
{
    $catagory_name = $sub_catagory['parent_catagory'];
    $sub_catagory_name = $sub_catagory['child_catagory'];
    $finalUrl = $base_url.nameBeautify($catagory_name).'/'.nameBeautify($sub_catagory_name).'/'.$sub_catagory['child_id'];
    $data .= urlElement($finalUrl, $today_date,'0.5');
    $urlarray[] =$finalUrl;
}

while ($sub_sub_catagory = mysqli_fetch_array($sub_sub_catagory_retval, MYSQL_ASSOC ))
{
    $catagory_name = $sub_sub_catagory['parent_catagory'];
    $sub_catagory_name = $sub_sub_catagory['child_catagory'];
    $sub_sub_catagory_name  = $sub_sub_catagory['sub_child_catagory'];
    $finalUrl = $base_url.nameBeautify($catagory_name).'/'.nameBeautify($sub_catagory_name).'/'.nameBeautify($sub_sub_catagory_name).'/'.$sub_sub_catagory['sub_child_id'];
    $data .= urlElement($finalUrl, $today_date,'0.5');
    $urlarray[] =$finalUrl;
}



while ( $sub_sub_sub_catagory = mysqli_fetch_array($sub_sub_sub_catagory_retval, MYSQL_ASSOC ))
{
    $catagory_name = $sub_sub_sub_catagory['parent_catagory'];
    $sub_catagory_name = $sub_sub_sub_catagory['child_catagory'];
    $sub_sub_catagory_name = $sub_sub_sub_catagory['sub_child_catagory'];
    $sub_sub_sub_catagory_name = $sub_sub_sub_catagory['sub_sub_child_catagory'];
    $finalUrl = $base_url.nameBeautify($catagory_name).'/'.nameBeautify($sub_catagory_name).'/'.nameBeautify($sub_sub_catagory_name).'/'.nameBeautify($sub_sub_sub_catagory_name) .'/'.$sub_sub_sub_catagory['sub_sub_child_id'];
    $data .= urlElement($finalUrl, $today_date,'0.5');
    $urlarray[] =$finalUrl;
}
// $productD = '';
// $productJ  = array( );
// //print_r($product_retvalJ);
// while ($productD = mysqli_fetch_object($product_retval) )
// {
//     $productJ[] =array(
//         'productNAME' =>$productD->product_name,
//         'ProductID' =>$productD->product_id
//     );
// }

$data .= "</urlset>";
$xml_open = fopen('/var/www/bnb-l/sitemap.xml', 'w');
fwrite($xml_open, $data);
fclose($xml_open);

// $json_open = fopen('./sitemapjson.json', 'w');
// fwrite($json_open, $json);
// fclose($json_open);
?>
