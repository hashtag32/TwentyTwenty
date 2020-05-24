<?php

function filter_subcategory( ) {
	$cat = get_queried_object();

	if(  $cat->category_parent ==187 ) //stocks
	{	
		$single_template=get_template_directory() . '/own-template-parts/template-subcategory-stocks.php' ;
	}
	elseif (  $cat->category_parent ==271 ) //smart_contracts
	{
		$single_template=get_template_directory() . '/own-template-parts/template-subcategory-smart-contracts.php' ;
	}
    return $single_template; 
}
add_filter( 'category_template', 'filter_subcategory' ); 


function add_pages_to_search( $query ) {
    if ( $query->is_search ) {
		$query->set( 'post_type', array('post','page') ); 
        add_query_arg( 'cat', "stocks" );
    }
    return $query;
}
add_filter('pre_get_posts','add_pages_to_search');

// Also include unused categories 
add_filter('wpseo_sitemap_exclude_empty_terms', '__return_false');

//***Currently not working
add_action( 'init', 'create_stock_taxonomy' );

function create_stock_taxonomy() {
    // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Stocks', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Stock', 'taxonomy singular name', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'stocks', array( 'post' ), $args );
}




//*** Cronjobs
add_action( 'updatestockdb', 'updateStockDB_func' );
 
function updateStockDB_func() {
	writeDBtoFile();
	updateStockTable();
	return;
}

function updateStockTable()
{
	$conn = connectDB();

	// Iterate through all subcategories-stocks
	foreach(getAllSymbols() as $symbolArray)
	{
		$symbol=$symbolArray["SymbolName"];
		$symbol=strtoupper($symbol); // Everywhere always big letters
		$stockName=update_getStockName($symbol);
		
		$stockPrice=update_getStockValue($symbol);
		$votingPrice=getVoting($symbol);
		$stockDiff = getStockDiff( $symbol, $votingPrice, $stockPrice);
		// Automatically insert/update
		$sql = "REPLACE INTO StockTable (symbol, stockName, stockPrice, votingPrice, stockDiff) VALUES ('{$symbol}', '{$stockName}', '{$stockPrice}', '{$votingPrice}', '{$stockDiff}')";
		$result = $conn->query($sql);
		//todo: check result  
	} 
 
	return closeconnectDB($conn);
}

function writeDBtoFile()
{
	// Table to propagate
	$tableList = array('ContractActionKO_creation', 'ContractActionSB_creation');
	// Get data from contracts
	foreach($tableList as $tableName){
		$sqlString = "SELECT * FROM " . $tableName;
		$sqlResult=executeSQLCommand($sqlString);
		$string_array=queryResultToArray($sqlResult);

		// Write contract data to file
		$fileName = 'openShare/'.$tableName . '.csv';
		$fileHandle = fopen($fileName, 'w');

		foreach ($string_array as $element) {
			fputcsv($fileHandle, [$element["contract_address"], $element["underlying"]], ',');
		}

		fclose($fileHandle);
	}

    return $string_array;
}

function update_getStockName($symbol)
{
	// Get name from API
	$data_arr=fetch_fmpcloud_feed($symbol, "quote")[0];
	$stockName=$data_arr["name"];
	
	return $stockName;
}

function update_getStockValue($symbol) 
{
	// Get newest value from alpha vantage
	$data_arr=fetch_fmpcloud_feed($symbol, "quote")[0];
	$price=$data_arr["price"];
	 
	if($price!=0)
	{
		return $price;
	}
	// Not successful
	return 0;
}


// Redirect stocks
// Remember! When changing this function, you need to update the Permalink
add_action('init', function() {
    $stocks_page_id = 909; // Stocks Template Page
	$stock_page_data = get_post( $stocks_page_id );

    if( ! is_object($stock_page_data) ) { // post not there
        return;
    }

	add_rewrite_rule(
        '^stocks/?([^/]*)/?',
        'index.php?pagename=' . $stock_page_data->post_name . '&symbol=$matches[1]',
        'top'
	);
});

// Redirect smart contracts
// add_action('init', function() {
// 	$smart_contracts_page_id = 921; // Smart Contracts Template Page
// 	$smart_contracts_page_data = get_post( $smart_contracts_page_id );
	
//     if( ! is_object($smart_contracts_page_data) ) { // post not there
//         return;
//     }

// 	add_rewrite_rule(
//         '^smart_contracts/?([^/]*)/?',
//         'index.php?pagename=' . $smart_contracts_page_data->post_name . '&smart_contract=$matches[1]',
//         'top'
//     );
// }); 


add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'symbol';
    $query_vars[] = 'smart_contract';
    return $query_vars;
} );



// Include bootstrap
function wps_scripts() {
    /* Theme CSS */
    wp_enqueue_style(
        'wps-style',
        get_stylesheet_uri(),
        array( 'bootstrap' ),
        '1.0.0'
    );
    
    /* Bootstrap CSS */
    wp_enqueue_style( 
        'bootstrap',
        get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css',
        array(),
        '4.4.1'
    );

    /* Bootstrap JS */
    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js',
        array( 'jquery' ),
        '4.4.1', 
        true
    );
}

add_action(
    'wp_enqueue_scripts',
    'wps_scripts'
);
 
?>