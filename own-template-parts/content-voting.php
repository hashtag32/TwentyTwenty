<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
<!-- <script src="https://www.gstatic.com/charts/loader.js" ></script> -->


<script type="text/javascript" src="https://stockvoting.net/wp-content/themes/twentytwenty/js/charts.js"> </script>
<script type="text/javascript" src="https://stockvoting.net/wp-content/themes/twentytwenty/own-template-parts/third-party/canvas-gauges/gauge.min.js"></script>

<style>
/* * {
  box-sizing: border-box;
} */

/* Create two equal columns that floats next to each other */
.column-voting {
  float: left;
  width: 33%;
  padding: 10px;
  /* border: 1px solid black; */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
} 
</style>





<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->
			
	<div class="section-inner">
		
	<?php

	function connectDB()
	{
		$conn = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
	
	function insertEntry($conn, $symbol, $current_price, $forecast)
	{
		$sql = "INSERT INTO voting (symbol, current_price, forecast) VALUES ('{$symbol}', '{$current_price}', '{$forecast}')";
		$result = $conn->query($sql);
		return $result;
	}

	function readEntry($conn, $symbol)
	{
		//todo: voting as global table name
		$sql = "SELECT symbol, current_price, forecast FROM voting";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				// echo "id: " . $row["symbol"]. " - Name: " . $row["current_price"]. " " . $row["lastname"]. "<br>";
				if($row["symbol"]=="Test2")
				{
					return $row["forecast"];
				}
			}
		} else {
			echo "0 results";
		}
	}
		

	$conn = connectDB();
	$result=insertEntry($conn, "Test2",11,14);
	$forecast=readEntry($conn, "Test2");

	$string = file_get_contents("http://finance.google.com/finance/info?client=ig&q=TSLA");
	$arrMatches = explode('// ', $string); // get uncommented json string
	$arrJson = json_decode($arrMatches[1], true)[0]; // decode json
	$price = $assJson["l"];
	echo $price;



	// echo $forecast;
	?>

<div class="row">
<a href="https://stockvoting.net/tag/tesla/"><h1>Tesla</h1></a>
	<div class="column-voting">
	  <!-- First column=Overview -->
	  Overview
	  Total prognosis

  </div>
  <div class="column-voting">
	  <!-- Second column=Radial gauge -->
	  <canvas data-type="radial-gauge"
	  		data-width="250"
        	data-height="250"
			data-title="false"
			data-value="0"
			data-min-value="0"
			data-max-value="220"
			data-major-ticks="0,20,40,60,80,100,120,140,160,180,200,220"
			data-minor-ticks="2"
			data-stroke-ticks="false"
			data-highlights='[
				{ "from": 0, "to": 50, "color": "rgba(0,255,0,.15)" },
				{ "from": 50, "to": 100, "color": "rgba(255,255,0,.15)" },
				{ "from": 100, "to": 150, "color": "rgba(255,30,0,.25)" },
				{ "from": 150, "to": 200, "color": "rgba(255,0,225,.25)" },
				{ "from": 200, "to": 220, "color": "rgba(0,0,255,.25)" }
			]'
			data-color-plate="#222"
			data-color-major-ticks="#f5f5f5"
			data-color-minor-ticks="#ddd"
			data-color-title="#fff"
			data-color-units="#ccc"
			data-color-numbers="#eee"
			data-color-needle-start="rgba(240, 128, 128, 1)"
			data-color-needle-end="rgba(255, 160, 122, .9)"
			data-value-box="true"
			data-animation-rule="bounce"
			data-animation-duration="500"
			data-font-value="Led"
			data-animated-value="true"
			data-animation-rule="elastic"
			data-animation-duration="500"
			animateOnInit="false"
			animatedValue="150"
	></canvas>
  </div>
	<div class="column-voting">
		<!-- Third column = Your vote -->
		<!-- todo: Change to int type and value to default value -->
		<h3>Your vote</h3>
		<input type="text" name="fnum" value="121"/>
	<button onclick="vote()">Vote</button>

	</div>
	</div>






	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->


<script>
if (!Array.prototype.forEach) {
    Array.prototype.forEach = function(cb) {
        var i = 0, s = this.length;
        for (; i < s; i++) {
            cb && cb(this[i], i, this);
        }
    }
}

document.fonts && document.fonts.forEach(function(font) {
    font.loaded.then(function() {
        if (font.family.match(/Led/)) {
            document.gauges.forEach(function(gauge) {
                gauge.update();
            });
        }
    });
});

var timers = [];

function animateGauges() {
    document.gauges.forEach(function(gauge) {
        timers.push(setInterval(function() {
            gauge.value = Math.random() *
                (gauge.options.maxValue - gauge.options.minValue) / 4 +
                gauge.options.minValue / 4;
        }, gauge.animation.duration + 50));
    });
}

function stopGaugesAnimation() {
    timers.forEach(function(timer) {
        clearInterval(timer);
    });
}
</script>