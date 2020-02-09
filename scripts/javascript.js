
 //Filen är uppdelad i moduler för att undvika globala funktioner
 //tanken är att koden ska initieras från Main-funktionen.

 
 var UserSettings = (function () {
	var dataStore = (function(){
			 
		var myLocations = function(){
			return getLocationsList();
		};

		var setLocations = function(locations){
			localStorage.setItem("myLocations", JSON.stringify(locations));
		};
		var removeLocations = function(){
			localStorage.removeItem("myLocations");
		};
		var getLocationsList = function(){	
			return JSON.parse(localStorage.getItem("myLocations"));
		};
		return {
			 myLocations: myLocations,
			 setLocations: setLocations,
			 removeLocations: removeLocations
		};
	 })();
		
	var editLocations = function(){
		var selectBox = document.getElementById('js-location-select');
		var selected = selectBox.selectedOptions;
		var optionValues = [];
		
		//sorterar ut namnen på städerna jag valt i selectboxen 'js-location-select'
		//och lägger dem i en lista med strängar (optionValues)
		for(var i = 0; i < selected.length; i++){
			if(selected[i].value === "All"){
				dataStore.removeLocations();
				window.location.reload(true);
				return;
			}else{
				optionValues.push(selected[i].value);
			}
		};
		dataStore.removeLocations();
		dataStore.setLocations(optionValues); //sparar de städer jag valt
		window.location.reload(true);  //ladda om sidan för att se de nya valen
	};
    return {
		dataStore: dataStore,
		editLocations: editLocations
    };
})();


 var Evenemang = (function () {
	var events = document.querySelectorAll('.js-event');
		 
	var filterEvents = function(){		
		var myLocations = UserSettings.dataStore.myLocations();
		if(myLocations === null){return;}
		var eventCity;
		var isSaved = function(city){
			return city === eventCity;				 
		};
		//loopar igenom alla divar med klassen "js-event" och kollar om eventets stad finns med i mina sparade locations
		//om namnet på staden inte finns, döljs diven
		for(var i = 0; i < events.length; i++){
			var locationElement = events[i].querySelector('.js-location');			
			eventCity = locationElement.innerHTML;
						
			var found = myLocations.find(isSaved)
			if(!found){
				events[i].parentNode.removeChild(events[i]);
			};
		}	
	};
	
    return {
        filterEvents: filterEvents
    };
})();

	
 var Main = (function () { 
    Evenemang.filterEvents();
 })();
 


