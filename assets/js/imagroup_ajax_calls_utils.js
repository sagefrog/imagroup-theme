window.cyrb53 = (str, seed = 0) => {
  let h1 = 0xdeadbeef ^ seed, h2 = 0x41c6ce57 ^ seed;
  for(let i = 0, ch; i < str.length; i++) {
      ch = str.charCodeAt(i);
      h1 = Math.imul(h1 ^ ch, 2654435761);
      h2 = Math.imul(h2 ^ ch, 1597334677);
  }
  h1  = Math.imul(h1 ^ (h1 >>> 16), 2246822507);
  h1 ^= Math.imul(h2 ^ (h2 >>> 13), 3266489909);
  h2  = Math.imul(h2 ^ (h2 >>> 16), 2246822507);
  h2 ^= Math.imul(h1 ^ (h1 >>> 13), 3266489909);

  return 4294967296 * (2097151 & h2) + (h1 >>> 0);
};

(function(maps, undefined){
  maps.util = maps.util || {};

  maps.util.addNorthOverlay = ()=>{
    const northPolyCoords = [
      {lat: 89.99, lng: -141.056208},
      {lat: 60.357866, lng: -141.056208},
      {lat: 58.936902, lng: -137.454071},
      {lat: 59.743596, lng: -135.563161},
      {lat: 56.690556, lng: -131.781341},
      {lat: 56.057853, lng: -130.199192},
      {lat: 54.988252, lng: -130.243167},
      {lat: 54.404145, lng: -132.661773},
      {lat: 53.966993, lng: -133.541266},
      {lat: 89.99, lng: -133.541266},
      
      ];
      
      const northPoly = new google.maps.Polygon({
        paths: northPolyCoords,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly.setMap(maps.obj.map);
      
      const northPolyCoords2 = [
      {lat: 89.99, lng: -133.541266},
      {lat: 50.533289, lng: -133.541266},
      {lat: 50.533289, lng: -131.217666},
      {lat: 48.512397, lng: -124.743613},
      {lat: 48.251827, lng: -123.509978},
      {lat: 48.408864, lng: -123.202174},
      {lat: 48.690436, lng: -123.267023},
      {lat: 48.768148, lng: -123.011325},
      {lat: 48.830755, lng: -123.010153},
      {lat: 49.001038, lng: -123.322017},
      {lat: 49.001038, lng: -95.153508},
      {lat: 49.384312, lng: -95.153378},
      {lat: 89.99, lng: -95.153378},
      ];
      
      const northPoly2 = new google.maps.Polygon({
        paths: northPolyCoords2,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly2.setMap(maps.obj.map);
      
      
      
      const northPolyCoords3 = [
      {lat: 89.99, lng: -95.144374},
      {lat: 48.884312, lng: -95.153378},
      {lat: 48.87815, lng: -95.144374},
      {lat: 48.875008, lng: -95.136977},
      {lat: 48.873388, lng: -95.132468},
      {lat: 48.87037, lng: -95.128731},
      {lat: 48.87037, lng: -95.128731},
      {lat: 48.852061, lng: -95.021206},
      {lat: 48.867937, lng: -94.988912},
      {lat: 48.870046, lng: -94.957258},
      {lat: 48.824498, lng: -94.854787},
      {lat: 48.820965, lng: -94.815575},
      {lat: 89.99, lng: -94.815575},
      ];
      
      const northPoly3 = new google.maps.Polygon({
        paths: northPolyCoords3,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly3.setMap(maps.obj.map);
      
      
      const northPolyCoords4 = [
      {lat: 89.99, lng: -94.815575},
      {lat: 49.320965, lng: -94.815575},
      {lat: 49.308832, lng: -94.823759},
      {lat: 49.293944, lng: -94.825992},
      {lat: 49.198048, lng: -94.797801},
      {lat: 49.119466, lng: -94.772378},
      {lat: 49.098339, lng: -94.749704},
      {lat: 48.883542, lng: -94.681147},
      {lat: 48.780104, lng: -94.690407},
      {lat: 48.707658, lng: -94.539244},
      {lat: 48.695875, lng: -94.268525},
      {lat: 48.529054, lng: -93.339801},
      {lat: 48.051808, lng: -91.387236},
      {lat: 47.914041, lng: -89.13466},
      {lat: 48.303979, lng: -88.229096},
      {lat: 89.99, lng: -88.229096},
      ];
      
      const northPoly4 = new google.maps.Polygon({
        paths: northPolyCoords4,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly4.setMap(maps.obj.map);
      
      
      const northPolyCoords5 = [
      {lat: 89.99, lng: -88.229096},
      {lat: 48.303979, lng: -88.229096},
      {lat: 45.31884, lng: -82.431958},
      {lat: 42.191263, lng: -83.087964},
      {lat: 41.856649, lng: -83.087964},
      {lat: 41.676374, lng: -82.604243},
      {lat: 42.814922, lng: -78.96534},
      {lat: 42.893283, lng: -78.907851},
      {lat: 42.940551, lng: -78.915366},
      {lat: 42.957137, lng: -78.95934},
      {lat: 42.986277, lng: -79.018431},
      {lat: 43.019921, lng: -79.025227},
      {lat: 89.99, lng: -79.025227},
      ];
      
      const northPoly5 = new google.maps.Polygon({
        paths: northPolyCoords5,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly5.setMap(maps.obj.map);
      
      
      
      const northPolyCoords6 = [
      {lat: 89.99, lng: -79.025227},
      {lat: 43.019921, lng: -79.025227},
      {lat: 43.057059, lng: -78.999804},
      {lat: 43.079975, lng: -79.076158},
      {lat: 43.106926, lng: -79.058263},
      {lat: 43.114947, lng: -79.061014},
      {lat: 43.12046, lng: -79.069431},
      {lat: 43.126725, lng: -79.0581},
      {lat: 43.138626, lng: -79.044193},
      {lat: 43.151401, lng: -79.04368},
      {lat: 43.16793, lng: -79.050205},
      {lat: 43.200223, lng: -79.048999},
      {lat: 43.212736, lng: -79.055698},
      {lat: 43.254633, lng: -79.055871},
      {lat: 89.99, lng: -79.055871},
      ];
      
      const northPoly6 = new google.maps.Polygon({
        paths: northPolyCoords6,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly6.setMap(maps.obj.map);
      
      
      const northPolyCoords7 = [
      {lat: 89.99, lng: -79.055871},
      {lat: 43.254633, lng: -79.055871},
      {lat: 43.262384, lng: -79.070472},
      {lat: 43.518369, lng: -78.419225},
      {lat: 44.112918, lng: -76.364731},
      {lat: 44.983621, lng: -74.868885},
      {lat: 45.014695, lng: -71.471842},
      {lat: 47.468369, lng: -69.199712},
      {lat: 47.349408, lng: -68.188295},
      {lat: 47.035854, lng: -67.748548},
      {lat: 45.69407, lng: -67.8163},
      {lat: 45.540383, lng: -67.420528},
      {lat: 45.146574, lng: -67.409535},
      {lat: 45.123323, lng: -67.090718},
      {lat: 42.995357, lng: -65.95719},
      {lat: 33.052414, lng: -51.800774},
      {lat: 60.486998, lng: -12.573387},
      {lat: 89.99, lng: 7.5},
      ];
      
      const northPoly7 = new google.maps.Polygon({
        paths: northPolyCoords7,
        strokeColor: "white",
        strokeOpacity: 0.999,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      northPoly7.setMap(maps.obj.map);
  }

  maps.util.addSouthOverlay = ()=>{
    
const southPolyCoords = [
  {lat: 0, lng: -136.052105},
  {lat: 32.567286, lng: -136.052105},
  {lat: 32.567286, lng: -117.476697},
  {lat: 32.52098, lng: -117.229339},
  {lat: 32.717255, lng: -114.758797},
  {lat: 32.500985, lng: -114.820384},
  {lat: 0, lng: -114.820384},
  ];
  
  const southPoly = new google.maps.Polygon({
    paths: southPolyCoords,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly.setMap(maps.obj.map);
  
  
  const southPolyCoords1 = [
  {lat: 0, lng: -114.820384},
  {lat: 32.500985, lng: -114.820384},
  {lat: 31.294394, lng: -110.937677},
  {lat: 31.406982, lng: -108.211249},
  {lat: 31.818647, lng: -108.255223},
  {lat: 31.706556, lng: -106.538099},
  {lat: 30.589159, lng: -104.892884},
  {lat: 0, lng: -104.892884},
  ];
  
  const southPoly1 = new google.maps.Polygon({
    paths: southPolyCoords1,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly1.setMap(maps.obj.map);
  
  
  
  const southPolyCoords2 = [
  {lat: 20, lng: -104.892884},
  {lat: 30.589159, lng: -104.892884},
  {lat: 29.485931, lng: -104.277238},
  {lat: 28.987421, lng: -103.155885},
  {lat: 29.75335, lng: -102.408315},
  {lat: 29.600626, lng: -101.286962},
  {lat: 28.525114, lng: -100.47437},
  {lat: 26.498537, lng: -99.177117},
  {lat: 20, lng: -99.177117},
  ];
  
  const southPoly2 = new google.maps.Polygon({
    paths: southPolyCoords2,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly2.setMap(maps.obj.map);
  
  const southPolyCoords2b = [
  {lat: 0, lng: -104.892884},
  {lat: 20, lng: -104.892884},
  {lat: 20, lng: -99.177117},
  {lat: 0, lng: -99.177117},
  ];
  
  const southPoly2b = new google.maps.Polygon({
    paths: southPolyCoords2b,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly2b.setMap(maps.obj.map);
  
  
  const southPolyCoords2a = [
  {lat: 0, lng: -99.177117},
  {lat: 26.498537, lng: -99.177117},
  {lat: 25.768668, lng: -97.176271},
  {lat: 24.023261, lng: -83.092429},
  {lat: 23.874222, lng: -80.922227},
  {lat: 24.99446, lng: -79.668949},
  {lat: 28.021985, lng: -78.613455},
  {lat: 23.25838, lng: -69.63859},
  {lat: 19.232553, lng: -67.915625},
  {lat: 17.527184, lng: -67.539647},
  {lat: 17.208197, lng: -64.079702},
  {lat: 19.305149, lng: -63.661942},
  {lat: 14.300316, lng: -45.75557},
  {lat: 1.202915, lng: -23.023314},
  {lat: 0, lng: -23.023314},
  ];
  
  const southPoly2a = new google.maps.Polygon({
    paths: southPolyCoords2a,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly2a.setMap(maps.obj.map);
  
  const southPolyCoords3 = [
  {lat: 0, lng: -23.023314},
  {lat: -10.99, lng: -23.023314},
  {lat: -10.99, lng: -136.052105},
  {lat: 0, lng: -136.052105},
  ];
  
  const southPoly3 = new google.maps.Polygon({
    paths: southPolyCoords3,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly3.setMap(maps.obj.map);
  
  const southPolyCoords4 = [
  {lat: -10.99, lng: -23.023314},
  {lat: -20.99, lng: -23.023314},
  {lat: -20.99, lng: -136.052105},
  {lat: -10.99, lng: -136.052105},
  ];
  
  const southPoly4 = new google.maps.Polygon({
    paths: southPolyCoords4,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly4.setMap(maps.obj.map);
  
  const southPolyCoords5 = [
  {lat: -20.99, lng: -23.023314},
  {lat: -50.99, lng: -23.023314},
  {lat: -50.99, lng: -136.052105},
  {lat: -20.99, lng: -136.052105},
  ];
  
  const southPoly5 = new google.maps.Polygon({
    paths: southPolyCoords5,
    strokeColor: "white",
    strokeOpacity: 1,
    strokeWeight: 2,
    fillColor: "white",
    fillOpacity: 1.000,
  });
  
  southPoly5.setMap(maps.obj.map);
  
  }

  maps.util.addWestOverlay = ()=>{
    const westPolyCoords = [
      {lat: 66, lng: -179.99},
      {lat: 66, lng: -168.96022},
      {lat: 62.488856, lng: -174.006888},
      {lat: 53.164887, lng: -174.217606},
      {lat: 20.112682, lng: -179.99},
      {lat: 66, lng: -179.99},
      ];
      
      const westPoly = new google.maps.Polygon({
        paths: westPolyCoords,
        strokeColor: "white",
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      westPoly.setMap(maps.obj.map);
      
      const westPolyCoords1 = [
      {lat: 89.99, lng: -179.99},
      {lat: 66, lng: -179.99},
      {lat: 66, lng: -168.96022},
      {lat: 89.99, lng: -168.96022},
      ];
      
      const westPoly1 = new google.maps.Polygon({
        paths: westPolyCoords1,
        strokeColor: "white",
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      westPoly1.setMap(maps.obj.map);
      
      
      const westPolyCoords2 = [
      {lat: 0.00, lng: -169.032549},
      {lat: -89.9, lng: -169.032549},
      {lat: -89.9, lng: -179.9},
      {lat: 0.00, lng: -179.9},
      ];
      
      const westPoly2 = new google.maps.Polygon({
        paths: westPolyCoords2,
        strokeColor: "white",
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: "white",
        fillOpacity: 1.000,
      });
      
      westPoly2.setMap(maps.obj.map);
  }
  
  maps.util.addOverlays = ()=>{
    maps.util.addWestOverlay();
    maps.util.addNorthOverlay();
    maps.util.addSouthOverlay();
  }
}(window.maps = window.maps || {}));

window.customRenderer = {
  render: function (params, stats, map)
  {
      // change color if this cluster has more markers than the mean cluster
      // const color =
      //   params.count > Math.max(10, stats.clusters.markers.mean)
      //     ? "#a380c3"
      //     : "#a380c3";      
      const color = "#8c9abb";

      // create svg url with fill color
      const svg = window.btoa(`
      <svg fill="${color}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240">
        <circle cx="120" cy="120" opacity=".7" r="70" />
      </svg>`);

      // create marker using svg icon
      return new google.maps.Marker({
        position: params.position,
        icon: {
          url: `data:image/svg+xml;base64,${svg}`,
          scaledSize: new google.maps.Size(45, 45),
        },
        label: {
          text: String(params.count),
          color: "rgba(255,255,255,0.9)",
          fontSize: "12px",
        },
        // adjust zIndex to be above other markers
        zIndex: 1000 + params.count,
      })
  }
}


// function checkWebWorkers() {
//   return typeof Worker !== "undefined";
// }

// if (checkWebWorkers()) {
//   log("Web Workers are available.");
// } else {
//   log("Web Workers are not available.");
// }

// window.disableClustering = ()=>{
//   maps.obj.markerClusterer.reset();
//   maps.obj.markers.forEach(m=>{
//       m.setMap(maps.obj.map);
//   });
// }