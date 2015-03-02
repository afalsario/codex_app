<!DOCTYPE html>
<html>
<head>
	<title>Codex App</title>
</head>
<body>
<ol>
<?php

// This gets the contents of a page in the WP codex containing function references and definitions
$thePage = file_get_contents('https://developer.wordpress.org/reference/functions/page/138/');

// This returns a text-only version of the page, similar to "View Source"
$thePage = htmlspecialchars($thePage);

// These lines will trim code before and after the block of content that contains terms and definitions
$start = strpos($thePage, "article");
$end = strpos($thePage, htmlspecialchars("<nav"));
$newString = substr($thePage, $start, $end - $start );

// Explodes the new trimmed string to isolate individual blocks of code for each WP function
$stringArray = explode(htmlspecialchars('/">'), $newString);

$number = count($stringArray);

// Removes the first item in the array which contains excess code
array_shift($stringArray);

// This code isolates the function name from the rest of the code
foreach ($stringArray as $key => $value) {
	$endPos = strpos($value, htmlspecialchars("<"));

	$functionName = substr($value, 0, $endPos - 0);

	echo "<br>" . $functionName;

	$defStart = strpos($value, htmlspecialchars("</b>")) + 10;
	$defEnd = strpos($value, htmlspecialchars("</p>"));

	$definition = substr($value, $defStart, $defEnd - $defStart);

	echo $defStart;

	echo "<br>" . $definition;
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



