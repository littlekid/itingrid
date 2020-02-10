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

<div class="js-event">
  <h2>Klimathack #3</h2>
  <p class="js-location">Stockholm</p><p> 1 februari 2020</p>
  <h3>Ett hackathon med fokus på klimatkrisen. </h3>
  <p>Vad skapas på detta hack?</p>
  <p>Hacket fokuserar på information om klimatkrisen: vad är det här med klimatförändringar, varför är det en kris, hur bråttom är det och hur påverkar detta mig som bor i Sverige?</p>
  <p>Varje lag väljer en målgrupp och strävar efter att skapa information som når fram till denna målgrupp. Hela hacket fokuserar på detta och på slutet får lagen chans att visa upp sina alster.</p>
  <p><a href="https://klimathack.se" target="_blank">Anmälan</a></p>

</div>
<div class="js-event">
  <h2>Hack the pressure</h2>
  <p class="js-location">Piteå</p><p> 15 februari 2020</p>
  <h3>Hur kan vi genom innovation motverka kronisk stress och utbrändhet?</h3>
  <p>Är du en kreativ problemlösare eller tycker du om kodning? Har du en passion för att utforska, experimentera och skapa prototyper för att hitta de bästa lösningarna? Om svaret på dessa frågor är ja, är detta eventet för dig!</p>
  <p>Årets utmaning fokuserar på innovationer som motverkar kronisk stress och utbrändhet. Under det senaste decenniet har utbrändhet ökat och idag handlar var femte sjukskrivning om stress. I åldern 25-29 år har sjukantalet gått upp med 144% under de senaste sju åren.</p>
  <p>Tiden är knapp och bästa lösningarna belönas med presentkort på totalt 5000 kr. Bästa idé vinner 2500 kr och bästa tech-lösning 2500 kr.</p>
  <p><a href="https://morehack.se/#/apply/" target="_blank">Anmälan</a></p>

</div>

 <div>
	<select id="js-location-select" multiple onchange="UserSettings.editLocations()">
	  <option value="All">Visa alla</option>
	  <option value="Piteå">Piteå</option>
	  <option value="Stockholm">Stockholm</option>
	  <option value="Södertälje">Södertälje</option>
	</select>
  </div>

<p>Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.</p>

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
