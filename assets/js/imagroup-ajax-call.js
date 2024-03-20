window.addEventListener('load',function ($) {
  'use strict';

  window.white_pin_svg = `<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11.469" height="17.21" viewBox="0 0 11.469 17.21">
    <defs>
      <clipPath id="clppth-pin-white">
        <rect id="Rectangle_1219" data-name="Rectangle 1219" width="11.469" height="17.21" fill="#ff9e18"/>
      </clipPath>
    </defs>
    <g id="pin_white" transform="translate(0 0)">
      <g id="Group_608" data-name="Group 608" transform="translate(0 0)" clip-path="url(#clppth-pin-white)">
        <path id="Path_949" data-name="Path 949" d="M5.738,0A5.737,5.737,0,0,0,.689,8.464l4.733,8.561a.356.356,0,0,0,.313.185.353.353,0,0,0,.313-.185L10.783,8.46A5.74,5.74,0,0,0,5.738,0m0,8.6A2.867,2.867,0,1,1,8.605,5.738,2.87,2.87,0,0,1,5.738,8.6" fill="#fff"/>
      </g>
    </g>
  </svg>`;

  (function(maps, undefined){
    maps.settings = {
      enableAdvancedMap: false,        // uses map id
      enableMarkerClustering: true
    }

    maps.state = {
      mapInit: false,
      page: 0,
      formSerializedArray: undefined,
      lastRequestHash: -1,
      numWorkers: 5,
      state: undefined,
      zipcode: undefined,
      mapCenter: undefined
    }

    maps.obj = {
      map: undefined,
      mapBounds: undefined,
      markers: [],
      markersCache: [],
      markerClusterer : undefined,
      form: undefined
    }
    
    maps.util = maps.util || {};
    maps.util.milesToMeters = (miles) =>{
      return miles * 1609.34;
    }

    maps.util.getLatLng = async (address) => {
      try {
        var apiURL = 'https://maps.googleapis.com/maps/api/geocode/json';
        var apiKey =  maps.apikey; // Replace with your API key
        var fullUrl = `${apiURL}?address=${address}&key=${apiKey}`;
    
        const response = await fetch(fullUrl);
        const data = await response.json(); 
        if (data.status === 'OK') {
            console.log(data.results[0]);
            var lat = data.results[0].geometry.location.lat;
            var lng = data.results[0].geometry.location.lng;
            return {result: true, lat: lat, lng: lng};
        } else {
          return {result: false}
        }
      } catch (error) {
        log("%cimagroup-ajax-call.js error maps.util.getLatLng, could not find zip", consoleStyling.red);
        return {result: false}
      }
    }

    maps.dict = maps.dict || {};
    
    maps.dict.stateLocations = [{"state":"AL","lat":32.32,"lng":-86.9},{"state":"AK","lat":63.59,"lng":-154.49},{"state":"AZ","lat":34.05,"lng":-111.09},{"state":"AR","lat":35.2,"lng":-91.83},{"state":"CA","lat":36.78,"lng":-119.42},{"state":"CO","lat":39.55,"lng":-105.78},{"state":"CT","lat":41.6,"lng":-73.09},{"state":"DE","lat":38.91,"lng":-75.53},{"state":"DC","lat":38.91,"lng":-77.03},{"state":"FL","lat":27.66,"lng":-81.52},{"state":"GA","lat":32.16,"lng":-82.91},{"state":"HI","lat":19.9,"lng":-155.67},{"state":"ID","lat":44.07,"lng":-114.74},{"state":"IL","lat":40.63,"lng":-89.4},{"state":"IN","lat":40.55,"lng":-85.6},{"state":"IA","lat":41.88,"lng":-93.1},{"state":"KS","lat":39.01,"lng":-98.48},{"state":"KY","lat":37.84,"lng":-84.27},{"state":"LA","lat":31.24,"lng":-92.15},{"state":"ME","lat":45.25,"lng":-69.45},{"state":"MD","lat":39.05,"lng":-76.64},{"state":"MA","lat":42.41,"lng":-71.38},{"state":"MI","lat":44.31,"lng":-85.6},{"state":"MN","lat":46.73,"lng":-94.69},{"state":"MS","lat":32.35,"lng":-89.4},{"state":"MO","lat":37.96,"lng":-91.83},{"state":"MT","lat":46.88,"lng":-110.36},{"state":"NE","lat":41.49,"lng":-99.9},{"state":"NV","lat":38.8,"lng":-116.42},{"state":"NH","lat":43.19,"lng":-71.57},{"state":"NJ","lat":40.06,"lng":-74.41},{"state":"NM","lat":34.97,"lng":-105.03},{"state":"NY","lat":43.3,"lng":-74.22},{"state":"NC","lat":35.76,"lng":-79.02},{"state":"ND","lat":47.55,"lng":-101},{"state":"OH","lat":40.42,"lng":-82.91},{"state":"OK","lat":35.01,"lng":-97.09},{"state":"OR","lat":43.8,"lng":-120.55},{"state":"PA","lat":41.2,"lng":-77.19},{"state":"PR","lat":18.22,"lng":-66.59},{"state":"RI","lat":41.58,"lng":-71.48},{"state":"SC","lat":33.84,"lng":-81.16},{"state":"SD","lat":43.97,"lng":-99.9},{"state":"TN","lat":35.52,"lng":-86.58},{"state":"TX","lat":31.97,"lng":-99.9},{"state":"UT","lat":39.32,"lng":-111.09},{"state":"VT","lat":44.56,"lng":-72.58},{"state":"VA","lat":37.43,"lng":-78.66},{"state":"WA","lat":47.75,"lng":-120.74},{"state":"WV","lat":38.6,"lng":-80.45},{"state":"WI","lat":43.78,"lng":-88.79},{"state":"WY","lat":43.08,"lng":-107.29}]

    maps.dict.stateZooms = [{"state":"AL","zoom":7},{"state":"AK","zoom":4},{"state":"AZ","zoom":7},{"state":"AR","zoom":7},{"state":"CA","zoom":6},{"state":"CO","zoom":7},{"state":"CT","zoom":8},{"state":"DE","zoom":8},{"state":"DC","zoom":9},{"state":"FL","zoom":7},{"state":"GA","zoom":7},{"state":"HI","zoom":8},{"state":"ID","zoom":7},{"state":"IL","zoom":7},{"state":"IN","zoom":7},{"state":"IA","zoom":7},{"state":"KS","zoom":7},{"state":"KY","zoom":7},{"state":"LA","zoom":7},{"state":"ME","zoom":8},{"state":"MD","zoom":8},{"state":"MA","zoom":8},{"state":"MI","zoom":7},{"state":"MN","zoom":7},{"state":"MS","zoom":7},{"state":"MO","zoom":7},{"state":"MT","zoom":7},{"state":"NE","zoom":7},{"state":"NV","zoom":6},{"state":"NH","zoom":8},{"state":"NJ","zoom":8},{"state":"NM","zoom":7},{"state":"NY","zoom":7},{"state":"NC","zoom":7},{"state":"ND","zoom":7},{"state":"OH","zoom":7},{"state":"OK","zoom":7},{"state":"OR","zoom":7},{"state":"PA","zoom":7},{"state":"PR","zoom":8},{"state":"RI","zoom":8},{"state":"SC","zoom":8},{"state":"SD","zoom":7},{"state":"TN","zoom":7},{"state":"TX","zoom":6},{"state":"UT","zoom":7},{"state":"VT","zoom":8},{"state":"VA","zoom":7},{"state":"WA","zoom":7},{"state":"WV","zoom":8},{"state":"WI","zoom":7},{"state":"WY","zoom":7}]
    maps.needsRefactor = {};
    maps.needsRefactor.staticIcons = {
      "pin_green.svg": 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11.469" height="17.21" viewBox="0 0 11.469 17.21">
      <defs>
        <clipPath id="clip-path">
          <rect id="Rectangle_1219" data-name="Rectangle 1219" width="11.469" height="17.21" fill="#6abf4b"/>
        </clipPath>
      </defs>
      <g id="pin_green" transform="translate(0 0)">
        <g id="Group_608" data-name="Group 608" transform="translate(0 0)" clip-path="url(#clip-path)">
          <path id="Path_949" data-name="Path 949" d="M5.738,0A5.737,5.737,0,0,0,.689,8.464l4.733,8.561a.356.356,0,0,0,.313.185.353.353,0,0,0,.313-.185L10.783,8.46A5.74,5.74,0,0,0,5.738,0m0,8.6A2.867,2.867,0,1,1,8.605,5.738,2.87,2.87,0,0,1,5.738,8.6" fill="#6abf4b"/>
        </g>
      </g>
    </svg>`),
      "pin_yellow.svg": 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11.469" height="17.21" viewBox="0 0 11.469 17.21">
      <defs>
        <clipPath id="clip-path">
          <rect id="Rectangle_1219" data-name="Rectangle 1219" width="11.469" height="17.21" fill="#ff9e18"/>
        </clipPath>
      </defs>
      <g id="pin_yellow" transform="translate(0 0)">
        <g id="Group_608" data-name="Group 608" transform="translate(0 0)" clip-path="url(#clip-path)">
          <path id="Path_949" data-name="Path 949" d="M5.738,0A5.737,5.737,0,0,0,.689,8.464l4.733,8.561a.356.356,0,0,0,.313.185.353.353,0,0,0,.313-.185L10.783,8.46A5.74,5.74,0,0,0,5.738,0m0,8.6A2.867,2.867,0,1,1,8.605,5.738,2.87,2.87,0,0,1,5.738,8.6" fill="#ff9e18"/>
        </g>
      </g>
    </svg>`),
      "pin_blue.svg": 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11.469" height="17.21" viewBox="0 0 11.469 17.21">
      <defs>
        <clipPath id="clip-path">
          <rect id="Rectangle_1219" data-name="Rectangle 1219" width="11.469" height="17.21" fill="none"/>
        </clipPath>
      </defs>
      <g id="pin_blue" transform="translate(0 0)">
        <g id="Group_608" data-name="Group 608" transform="translate(0 0)" clip-path="url(#clip-path)">
          <path id="Path_949" data-name="Path 949" d="M5.738,0A5.737,5.737,0,0,0,.689,8.464l4.733,8.561a.356.356,0,0,0,.313.185.353.353,0,0,0,.313-.185L10.783,8.46A5.74,5.74,0,0,0,5.738,0m0,8.6A2.867,2.867,0,1,1,8.605,5.738,2.87,2.87,0,0,1,5.738,8.6" fill="#00b2e3"/>
        </g>
      </g>
    </svg>`)
    }
  }(window.maps = window.maps || {}));

  if (typeof IMAGroup_ajax_calls_vars !== 'undefined') {


    var hideInfoWindows;
    var checkOpenedWindows = new Array();

    var ajaxURL = IMAGroup_ajax_calls_vars.admin_url + 'admin-ajax.php';
    var googlemap_default_zoom = IMAGroup_ajax_calls_vars.googlemap_default_zoom;
    var google_map_style = IMAGroup_ajax_calls_vars.google_map_style;

    if (!jQuery('#explore-our-sites-map').length)
      return;

    if (google_map_style != '') {
      var google_map_style = JSON.parse(google_map_style);
    }

    var imagroup_is_mobile = false;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
      imagroup_is_mobile = true;
    }

    var US_BOUNDS = {
      default: {
        north: 71.40,
        south: -14.57,
        west: -179.15,
        east: -64.56
      },
      contiguous: {
        north: 49.35,
        south: 24.74,
        west: -124.79,
        east: -66.95
      },
      loose: {
        north: 81.40,
        south: -10,
        west: -179.99,
        east: -34.56 // was -34.56
      }
    }

    var mapOptions = {
      zoom: 4, //parseInt(googlemap_default_zoom) ?? 8
      maxZoom: 16,
      minZoom: 4,
      disableDefaultUI: false,
      scrollwheel: true,
      zoomControl: true,
      restriction: {
        latLngBounds: US_BOUNDS.loose,
        strictBounds: false
      },
      mapId: (maps.settings.enableAdvancedMap) ? "3ee09a1b362e97c3" : "",
      styles: google_map_style,
      // mapTypeId: google.maps.MapTypeId.ROADMAP,
      backgroundColor: 'hsla(0, 0%, 0%, 0)',
      gestureHandling: "greedy"
    };


    var special_chars = {
      '&amp;': '&',
      '&quot;': '"',
      '&#039;': "'",
      '&#8217;': "’",
      '&#038;': "&",
      '&lt;': '<',
      '&gt;': '>',
      '&#8216;': "‘",
      '&#8230;': "…",
      '&#8221;': '”',
      '&#8211;': "–",
      '&#8212;': "—"
    };

    window.removeMarkers = function(){
      if(maps.settings.enableMarkerClustering) {
        maps.obj.markerClusterer.markers.forEach(m=>{m.setMap(null)})
        maps.obj.markerClusterer.clearMarkers();
      }

      do {
        const markersToClear = maps.obj.markers.splice(0, maps.obj.markers.length);
        markersToClear.forEach(m => {
          m.setMap(null);
        });
      } while (maps.obj.markers.length > 0);
    }


    var imagroupAddMarkers = function (locations, map) {
      hideInfoWindows = function () {
        while (checkOpenedWindows.length > 0) {
          var closeWindow = checkOpenedWindows.pop();
          closeWindow.close();
        }
      };

      var imagroupMarkerInfoWindow = function (map, marker, infowindow) {
        google.maps.event.addListener(marker, 'click', function () {
          hideInfoWindows();
          infowindow.open(map, marker);
          checkOpenedWindows.push(infowindow);
        });
      };

      var createMapInfoWindow = (largeText, normalText)=>{
        var mainContent = document.createElement("div");
        mainContent.className = 'map-info-window';

        var innerHTML = "";
        innerHTML += '<div class="map-info-box">';
        innerHTML += '<p class="location-title">';
        innerHTML += largeText;
        innerHTML += '<span class="location-address">';
        innerHTML += normalText;
        innerHTML += '</span>';
        innerHTML += '</p>';
        innerHTML += '</div>';

        mainContent.innerHTML = innerHTML;

        return mainContent;
      }

      var createMarker = (lat, lng, id, title, icon)=>{
        const marker_url = icon == ""
          ? 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(window.white_pin_svg)
          : icon;

        // if (window.devicePixelRatio > 1.5 && retinaMarker) {
        //   marker_url = retinaMarker;
        //   // marker_size = new google.maps.Size(12, 18);
        // }

        const marker_icon = {
          url: marker_url,
          size: google.maps.Size(12, 18),
          scaledSize: new google.maps.Size(12, 18),
        };

        const marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat, lng),
          map: maps.obj.map,
          icon: marker_icon,
          // title: title.toString().replace(/\&[\w\d\#]{2,5}\;/g, function (s) { return special_chars[s]; }),
          // animation: google.maps.Animation.DROP,
          visible: true,
          marker_id: id,
          test: "test",
        });

        return marker;
      }

      for (var i = 0; i < locations.length; i++) {
        if (!locations[i].lat || !locations[i].lng) {
          continue;
        }

        const firstTermId = locations[i].types[0].id;
        const icon_url = maps.needsRefactor.termToPin[firstTermId];
        const icon_short_name = icon_url ? icon_url.split('/').slice(-1)[0] : false;
        const icon = maps.needsRefactor.staticIcons[icon_short_name] ?? icon_url;

        const marker = createMarker(locations[i].lat, locations[i].lng, locations[i].id, locations[i].id, icon);
        const markerPosition = marker.getPosition();
        if(markerPosition) { maps.obj.mapBounds.extend(markerPosition);}

        imagroupMarkerInfoWindow(map, marker, new google.maps.InfoWindow({
          content: createMapInfoWindow(maps.needsRefactor.termNames[locations[i].types[0].id] ?? "", locations[i].zipcode  + "<br>" + locations[i].state)
        }));

        maps.obj.markers.push(marker);
      }
    }

    var createMarker = (lat, lng, id, title, icon)=>{
      const marker_url = icon == ""
        ? 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(window.white_pin_svg)
        : icon;

      // if (window.devicePixelRatio > 1.5 && retinaMarker) {
      //   marker_url = retinaMarker;
      //   // marker_size = new google.maps.Size(12, 18);
      // }

      const marker_icon = {
        url: marker_url,
        size: google.maps.Size(12, 18),
        scaledSize: new google.maps.Size(12, 18),
      };

      const marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: maps.obj.map,
        icon: marker_icon,
        // title: title.replace(/\&[\w\d\#]{2,5}\;/g, function (s) { return special_chars[s]; }),
        // animation: google.maps.Animation.DROP,
        visible: true,
        marker_id: id,
        test: "test",
      });

      return marker;
    }

    maps.addCircle = (miles = 100, map = maps.obj.map) => {
      let meters = maps.util.milesToMeters(miles);
      var circle = new google.maps.Circle({
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35,
          map: map,
          center: map.getCenter(), // using the map's current center
          radius: meters // meters
      });
    }

    maps.addMarker = (lat, lng, title = "", map = maps.obj.map, icon = false) => {
      // create marker
      const marker_url = icon == !icon
                                  ? 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(window.white_pin_svg)
                                  : icon;

      // if (window.devicePixelRatio > 1.5 && retinaMarker) {
      //   marker_url = retinaMarker;
      //   // marker_size = new google.maps.Size(12, 18);
      // }

      const marker_icon = {
        url: marker_url,
        size: google.maps.Size(12, 18),
        scaledSize: new google.maps.Size(12, 18),
      };

      new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: map,
        icon: marker_icon,
        title: title.replace(/\&[\w\d\#]{2,5}\;/g, function (s) { return special_chars[s]; }),
        // animation: google.maps.Animation.DROP,
        visible: true,
        // marker_id: id,
        test: "test",
      });
    }

   async function init_map(){
      const { Map } = await google.maps.importLibrary("maps");
      maps.obj.map = new Map(document.getElementById('explore-our-sites-map'), mapOptions);
      maps.util.addOverlays();
      maps.state.mapInit = true;
      maps.obj.mapBounds = new google.maps.LatLngBounds();
      maps.obj.form = jQuery('form[name="explore-our-sites"]');
      if(maps.settings.enableMarkerClustering) {
      maps.obj.markerClusterer = new markerClusterer.MarkerClusterer({
        markers: maps.obj.markers, 
        map: maps.obj.map,
        algorithmOptions: {
          maxZoom: 6,
          radius: 100,
        },
        renderer: {
          render:window.customRenderer.render
        }
      });
      }

      setInterval(() => {
        add_markers_async();
      }, 100);
      setInterval(() => {
        if(maps.settings.enableMarkerClustering) {
          maps.obj.markerClusterer.render();
          // maps.obj.markerClusterer = new markerClusterer.MarkerClusterer({ markers: maps.obj.markers, map: maps.obj.map, renderer: window.customRenderer });
        }
      }, 2500);

      map_ajax();
    };

    async function add_markers_async() {
      const numMarkersToAdd = (maps.obj.markersCache.length > 1000) ? 800 : 200;
      const markerSegment = maps.obj.markersCache.splice(0, numMarkersToAdd);
      if(markerSegment.length) {
        imagroupAddMarkers(markerSegment, maps.obj.map);
        // if (maps.state.state == undefined && maps.state.zipcode == undefined) {
        //   // maps.obj.map.fitBounds(maps.obj.mapBounds);
        // }
      }
    }

    
    let currentAsyncOperation = Promise.resolve();
    
    async function asyncOperation(increment) {
        return new Promise(resolve => {
            // Simulating some asynchronous work (e.g., a timeout)
            if(increment) {
              maps.state.page++; // Increment the shared resource
            }
            else {
              maps.state.page = 0;
            }
              resolve(maps.state.page); // Resolve with the new value
        });
    }
    
    function accessMapsStatePage(increment = true) {
        let releaseLock;
    
        // Create a lock that will be resolved when the operation is complete
        const lock = new Promise(resolve => {
            releaseLock = resolve;
        });
    
        // Queue the operation
        currentAsyncOperation = currentAsyncOperation.then(() => asyncOperation(increment)).then(newValue => {
            releaseLock(newValue); // Release the lock with the new value
            return newValue; // Pass the new value for further processing
        });
    
        return lock; // Return the promise that resolves with the new value
    }   
    
    async function map_ajax(chained = false, value = -1, radiusSourceLat = false, radiusSourceLng = false) {
      let zipcodeLatLngResult = false;

      if (!chained) {
        maps.state.formSerializedArray = maps.obj.form.serializeArray();
        // user has set state or zip code
        maps.state.formSerializedArray.forEach(function(fd) {
            if (fd.name === "state") {
              if(fd.value !== "") {
                const abbrevState = fd.value.toUpperCase();
                maps.state.state = abbrevState;
              }
              else {
                maps.state.state = undefined;
              }
            }
            if (fd.name === "zip") {
              if(fd.value !== "") {
                const zipcode = fd.value;
                if(!isNaN(parseInt(zipcode))) {
                  maps.state.zipcode = zipcode;
                }
              }
              else {
                maps.state.zipcode = undefined;
              }
            }
        });

        if (maps.state.state == undefined && maps.state.zipcode == undefined) {
          // maps.obj.map.fitBounds(maps.obj.mapBounds);
          console.log('us center');
          maps.obj.map.setZoom(4);
          maps.obj.map.setCenter({lat:38.468643, lng:-96.922996}); // center contiguous US
        }

        // set map center based off state input
        if (maps.state.state !== undefined) {
          let stateLocationResult = maps.dict.stateLocations.filter(o => o.state == maps.state.state);
          let stateZoomResult = maps.dict.stateZooms.filter(o => o.state == maps.state.state);
          let lng, lat, zoom;
          if (stateLocationResult.length > 0) {
            lat = parseFloat(stateLocationResult[0].lat);
            lng = parseFloat(stateLocationResult[0].lng);
          }
          if (stateZoomResult.length > 0) {
            zoom = parseFloat(stateZoomResult[0].zoom);
          }
          if(!isNaN(lat) && !isNaN(lng)) {
            if(maps.obj.map.zoom != zoom) {
              maps.obj.map.setZoom(zoom);
            }
            maps.obj.map.panTo({lng: lng, lat:lat});
            // maps.addCircle(100);  // show 100 miles
          }
        }

        //  set map center based off zipcode
        if (maps.state.zipcode !== undefined) {
          zipcodeLatLngResult = await maps.util.getLatLng(maps.state.zipcode);
          if (zipcodeLatLngResult.result) {
            radiusSourceLat = zipcodeLatLngResult.lat;
            radiusSourceLng = zipcodeLatLngResult.lng;
            if(maps.obj.map.zoom != 8) {
              maps.obj.map.setZoom(8);
            }
            setTimeout(() => {
              maps.obj.map.panTo({lng: zipcodeLatLngResult.lng, lat:zipcodeLatLngResult.lat, zoom: 8});
              // maps.addCircle(100);  // show 100 miles
            }, 100);
          }
        }

        maps.state.lastRequestHash = cyrb53(maps.obj.form.serialize());
        if(maps.settings.enableMarkerClustering) {
          maps.obj.markerClusterer.markers= maps.obj.markers;
        }
      }

      let requestData = structuredClone(maps.state.formSerializedArray);

      const thisPage = (value != -1) ? value : ++maps.state.page;

      let pageIndex = requestData.findIndex(item => item.name === 'page'); 
      if (pageIndex !== -1) {
          // If the page element exists, update its value
          requestData[pageIndex].value = thisPage;
      } else {
          // If the page element does not exist, add it to the requestData
          requestData.push({ 
              name: 'page', 
              value: thisPage
          });
      }
    
      let chainedIndex = requestData.findIndex(item => item.name === 'chained'); 
      if (chainedIndex !== -1) {
          // If the page element exists, update its value
          requestData[chainedIndex].value = chained;
      } else {
          // If the page element does not exist, add it to the requestData
          requestData.push({ 
              name: 'chained', 
              value: chained
          });
      }
    
      let requestHashIndex = requestData.findIndex(item => item.name === 'requestHash'); 
      if (requestHashIndex !== -1) {
          // If the page element exists, update its value
          // requestData[requestHashIndex].value = requestHash;
      } else {
          // If the page element does not exist, add it to the requestData
          requestData.push({ 
              name: 'requestHash', 
              value: maps.state.lastRequestHash
          });
      }

      let requestUrl = window.location.origin + "/wp-json/api/v2/explore-our-sites";
      if (maps.state.zipcode !== undefined) {
        requestUrl = window.location.origin + "/wp-json/api/v2/locations-radius";

        if (radiusSourceLat && radiusSourceLng) {
          let latIndex = requestData.findIndex(item => item.name === 'lat'); 
          if (latIndex !== -1) {
              // If the page element exists, update its value
              requestData[latIndex].value = radiusSourceLat;
          } else {
              // If the page element does not exist, add it to the requestData
              requestData.push({ 
                  name: 'lat', 
                  value: radiusSourceLat
              });
          }
          let lngIndex = requestData.findIndex(item => item.name === 'lng'); 
          if (lngIndex !== -1) {
              // If the page element exists, update its value
              requestData[lngIndex].value = radiusSourceLng;
          } else {
              // If the page element does not exist, add it to the requestData
              requestData.push({ 
                  name: 'lng', 
                  value: radiusSourceLng
              });
          }
        }
      }

      jQuery.ajax({
        type: 'get',
        // url: ajaxURL,
        url: requestUrl,
        dataType: 'json',
        data: requestData,
        beforeSend: function () {
        },
        success: function (response) {
          //  still relevant results
          if(response.termToPin) {
            if(!maps.needsRefactor.termToPin) {
              maps.needsRefactor.termToPin = {};
            }
            Object.keys(response.termToPin).forEach((key)=>{
              maps.needsRefactor.termToPin[key] = response.termToPin[key];
            })
          }
          if(response.termNames) {
            maps.needsRefactor.termNames = maps.needsRefactor.termNames || {};
            Object.keys(response.termNames).forEach((key)=>{
              maps.needsRefactor.termNames[key] = response.termNames[key];
            })
          }
          if(response.meta.requestHash == maps.state.lastRequestHash) {
            if (response.meta.chained == "false") {
              if (response.locations) {
                maps.obj.markersCache = [...(response.locations)];
                jQuery('.map-notfound').remove();
              } else {
                jQuery('.map-location').append('<div class="map-notfound">' + response.not_found + '</div>');
              }
              const maxWorkersToUse =  response.meta.max_num_pages - maps.state.page < maps.state.numWorkers 
                                        ? (response.meta.max_num_pages - maps.state.page)
                                        : maps.state.numWorkers;
              for(let i = 0; i < maxWorkersToUse; i++) {
                accessMapsStatePage().then(value => {
                  if(value <= response.meta.max_num_pages) {
                    // setTimeout(() => {
                      if(response.meta.lat && response.meta.lng) {
                        map_ajax(true, value, response.meta.lat, response.meta.lng);
                      } else {
                        map_ajax(true, value);
                      }
                    // }, 150);
                  }
                });
              }
            }
            else {
              accessMapsStatePage().then(value => {
                if (response.locations) {
                  maps.obj.markersCache = [...maps.obj.markersCache,...(response.locations)];
                  jQuery('.map-notfound').remove();
                } else {
                  jQuery('.map-location').append('<div class="map-notfound">' + response.not_found + '</div>');
                }
    
                if(value < response.meta.max_num_pages) {
                  map_ajax(true, parseInt(value));
                }
              });
            }

          }
        },
        error: function (xhr, status, error) {
          alert('An error has occurred. Please try again later.');
        }
      });
    }

    // Event Listeners
    jQuery('form[name=explore-our-sites]').on('submit', function (e) {
      e.stopImmediatePropagation();
      e.preventDefault();
      do {
        removeMarkers();
      } while (maps.obj.markers.length > 0);
      if(cyrb53(maps.obj.form.serialize()) != maps.state.lastRequestHash) {
        maps.state.lastRequestHash = 0;
        maps.obj.markersCache = [];
      }
      maps.obj.markersCache = [];
      do {
        removeMarkers();
      } while (maps.obj.markers.length > 0);
      clearTimeout(window.newMapRequestTimeout);
      window.newMapRequestTimeout = setTimeout(() => {
        accessMapsStatePage(false).then(value => {
          map_ajax();
        });
      }, 1);
    });

    jQuery('.selectpicker').on('change', ()=>{
      const selectedType = document.querySelector('select[name="type"]').value;
      jQuery('select[name="state"] option').map((i, option) => {
        let thisOptionTypes = option.getAttribute('data-typeslugs');
        let AOptionTypes = (thisOptionTypes) ? thisOptionTypes.split(',') : false;
        if(!AOptionTypes){return;}
        //  When All is selected
        if(selectedType == '') {
          option.removeAttribute('disabled');
        }
        else {
          if (AOptionTypes.indexOf(selectedType)>-1) {
            option.removeAttribute('disabled')
          }
          else {
            option.setAttribute('disabled','disabled')
          }
        }
      })
      jQuery('.selectpicker').selectpicker('refresh');
    })

    //  Main
    init_map();
  }
});
