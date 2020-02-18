<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IT-Ingrid (eller IT IN GRID om du vill!) | IT-Sveriges kalender och anslagstavla.</title>
  <link rel="stylesheet" href="design.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:title" content="Ingrid - IT-Sveriges kalender!" />
  <meta property="og:description" content="Upptäck evenemang (ex. hackathons och Sweden Demo Day), läs om intressanta personer som gör bra saker, upptäck öppna data som myndigheter tillgängliggjort, läs mer om olika platser och hitta frilansare. Du kan också berätta om ditt/dina hobbyprojekt och läsa om vad andra bygger!"/>
  <meta property="og:url" content="https://itingrid.se"/>
  <!-- Expire - because I do update content regurarly, and the page loads fairly quickly anyway :] -->
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
</head>
<body id="page-index">
<script>
function countVisits() {
  localCount = localStorage.getItem("nPreviousVisits");
  if (localCount == null || localCount == "null"){
    count = 0;
  } else {
    count = parseInt(localCount);
  }
  count++;
  if(count > 3){
   document.body.id += "-returning-visitor";
  }
  localStorage.setItem("nPreviousVisits", count);
  console.log(count);
}
countVisits();
</script>

  <header>
    <h1>Ingrid</h1>
    <h2>Sveriges IT-kalender</h2>
  </header>

<?php

      $cities_with_events = array("göteborg","lund","luleå","jönköping","malmö","piteå","skåne","stockholm","uppsala");
      if (isset($_GET['location']) && in_array(strtolower($_GET['location']), $cities_with_events)) {
        echo "<p style='font-size: 1.8rem; text-align: center; margin: 13vh auto 0'>IT-kalender för " . ucfirst($_GET['location']) . ".</p>";
      } else {
        echo '<p>Poulära orter: <a href="/Göteborg">Göteborg</a>, <a href="/Jönköping">Jönköping</a>, <a href="/Lund">Lund</a>, <a href="/Stockholm">Stockholm</a>, <a href="/Uppsala">Uppsala</a></p>';
      }
?>

  <div id="calendar">
    <input type="checkbox" value="call-for-papers" id="filter-call-for-papers"> <label for="filter-call-for-papers">call for papers</label>
    <input type="checkbox" value="hackathon" id="filter-hackathon"> <label for="filter-hackathon">hackathon 👩🏽‍💻</label>
    <input type="checkbox" value="conference" id="filter-conference"> <label for="filter-conference">konferens</label>
    <input type="checkbox" value="meetup" id="filter-meetup"> <label for="filter-meetup">meetup</label>

    <br><br><br>

      <?php
setlocale(LC_TIME, "sv_SE.UTF-8");

function pretty_date($date) {
  // $date = "YYYY-MM-DD";
  $parts = explode("-", $date);
  return strftime('%a %-d %B', mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
}

      $events_json = file_get_contents("calendar-items.json");
      $calendar_events = json_decode($events_json);
      $items = "";
      $location_filter = $GET['location'];
      if (isset($_GET['location']) && in_array(strtolower($_GET['location']), $cities_with_events)) {
        $chosen_city = strtolower($_GET['location']);

        function filterArray($event){
          global $chosen_city;
          //return (strtolower($event->location) == strtolower($chosen_city));
          return strpos(strtolower($event->location), strtolower($chosen_city)) > -1;
        }

        $calendar_events = array_filter($calendar_events, 'filterArray');
      }

      foreach ($calendar_events as $event_item) {
        $items .= '<div class="calendar-item" data-type="' . $event_item->category . '">';
        $items .= "<h2>" . $event_item->headline . "</h2>";
        $items .= '<p><span class="location">' . $event_item->location . '</span>';
        $items .= pretty_date($event_item->date) . "</p>";
        $items .= '<p class="tags">'.$event_item->tags.'</p>';
        $items .= '<h3>'.$event_item->description_headline.'</h3>';
        $items .= '<p>'.$event_item->description_first.'</p>';
        if($event_item->description_second){
        $items .= '<p>'.$event_item->description_second.'</p>';
        }
        if($event_item->description_third){
          $items .= '<p>'.$event_item->description_third.'</p>';
        }
        if($event_item->description_fourth){
          $items .= '<p>'.$event_item->description_third.'</p>';
        }
        if($event_item->description_fifth){
          $items .= '<p>'.$event_item->description_third.'</p>';
        }
        $items .= '<p><a href="'.$event_item->link.'" target="_blank">'.$event_item->link_text.'</a></p>';
        $items .= '</div>';
      }
      echo $items;
    ?>

  </div>

  <div id="hello-reason">
    <p>👋🏽 Hej!</p>
    <p>Jag vill själv få en notis när ett hackathon är på gång i Uppsala, eller om ett hackathon som rör sådant jag är intresserad av sker (oavsett var i landet).</p>
    <p>
    Jag har träffat så många människor som gör bra saker och hört talas om spännande projekt som inte alls får den uppmärksamhet de förtjänar.</p>
    <p>
    Träffar också många personer som vill komma igång och börja lära sig programmering, och ännu fler som har kommit igång men som inte vet hur de ska komma vidare för att få det där första jobbet, eller första praktikplatsen.
      Är också själv engagerad i många olika sammanhang och vet vilket jättejobb det är att rodda med meetups och vinterläger för att de över huvudtaget ska bli av - låt oss vara fler som får upp ögonen för att en liten insats kan göra stor skillnad!
    </p>
    <p>
    När människor möts händer det bra saker, det är jag övertygad om. Jag hoppas att Ingrid så småningom kommer växa upp och klara sig gott utan mig. :]<br><br>
      // <a href="https://victoriawagman.se" style="text-decoration: none;">Victoria</a>
    </p>
  </div>

  <div id="contribute">
    <p>Du kan också bidra till denna hemsida genom att <a href="mailto:victoria@kodkurs.se">skicka in förslag</a> eller själv <a href="https://github.com/littlekid/itingrid" target="_blank">lägga till innehåll (gör en pull request) → </a>.</p>
  </div>
</body>
</html>
