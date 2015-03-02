<!DOCTYPE html>
<html>
<head>
	<title>Codex App</title>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
<ol>
<?php

$thePage = file_get_contents('https://developer.wordpress.org/reference/functions/page/263/');
$thePage = htmlspecialchars($thePage);

$start = strpos($thePage, "article");
$end = strpos($thePage, htmlspecialchars("<nav"));

$newString = substr($thePage, $start, $end - $start );

echo $newString;

$stringArray = explode(htmlspecialchars('/">'), $newString);


echo '<pre>' . var_export($stringArray, true) . '</pre>';

$number = count($stringArray);

echo "Number of items in the array: " . $number;

echo '<br><br>';

array_shift($stringArray);

foreach ($stringArray as $key => $value) {
	$endPos = strpos($value, htmlspecialchars("<"));

	$functionName = substr($value, 0, $endPos - 0);

	echo "<br>" . $functionName;
}
 



?>



</ol>
	<h2>Codex App</h2>
	<p class="sayhello">Let's build an app! Let's also put it in a chrome extension.</p>
	<ol>
		<li>Once the chrome extention is activated, it will read through the content on a page.</li>
		<li>It will read through a list of terms and definitions on a json file and match terms with content on the page.</li>
		<li>It will then display all the matched terms and their definitions in the extension.</li>
	</ol>

	<h2>But first!!</h2>
	<p class="sayhello">Let's write a script that will work through the WordPress Codex to pull out all the function names and their definitions. (Codex Crawler)</p>

	<ol>
		<li>Loop through all the pages containing WP functions.</li>
		<li>For each page, grab all of the links on the page located within anchor tags in the " article > h1 ". This is the name of the function.</li>
		<li>Next, grab the text within the &lt;p&gt; tags in the "description" class. This is the description.</li>
	</ol>
</body>
</html>



