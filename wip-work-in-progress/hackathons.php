<?php
include "parsedown/Parsedown.php";
$Parsedown = new Parsedown();

function listCreator($htmlContentWithHeadlines, $id = ""){
  $list_items = '<li>'.str_replace("<h2", "</li><li><h2", $htmlContentWithHeadlines).'</li>';
  $list = '<ul id="'.$id.'">'.$list_items.'</ul>';
  return $list;
}

$hackathons_md   = file_get_contents("hackathons.md");
$hackathons_html = $Parsedown->text($hackathons_md);
$hackathons_list = listCreator($hackathons_html, "hackathons-list");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hackathons i Sverige 2020</title>
</head>
<body>
  <h1>Hackathons</h1>

  <?php echo $hackathons_list; ?>

<style>
body {
  max-width: 840px;
  margin: 2rem auto 1rem;
  padding-left: 2rem;
  padding-right: 2rem;
}

#hackathons-list {
  margin: calc(3rem + 13vh) 0 0;
  padding: 0;
  list-style: none;
  font-size: 1.3rem;
}

#hackathons-list li:not(:first-child) {
  margin-top: 5rem;
}

h1 {
  font-size: 4rem;
  margin-top: calc(4rem + 13vh);
  margin-bottom: 4rem;
  font-family: monospace;
  text-align: center;
}

h2 {
  font-size: 2.8rem;
  margin-top: 4.2rem;
  font-family: sans-serif;
  color: #222;
  font-family: monospace;
  letter-spacing: -.04rem;
}

h2:first-of-type {
  margin-top: 1rem;
}

h2, h3 {
  margin-bottom: 2px;
}

h2 + ul {
  margin: 0 0 2rem;
  padding: 0;
}

h2 + ul li {
  display: inline;
}

h2 + ul li:first-child:not(:last-child):after {
  content: ", ";
}

h3 {
  font-size: 1.4rem;
}

p {
  margin-top: 2px;
  color: #333;
  font-size: 1.3rem;
  line-height: 130%;
}
</style>

</body>
</html>
<script type="text/javascript" src="scripts/javascript.js"></script>
