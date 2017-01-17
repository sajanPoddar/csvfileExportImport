<html>
<
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q&libraries=places"
  type="text/javascript"></script>
  <script type="text/javascript">
                var map;        
                        var myCenter=new google.maps.LatLng(53, -1.33);
            var marker=new google.maps.Marker({
                position:myCenter
            });

            function initialize() {
              var mapProp = {
                  center:myCenter,
                  zoom: 14,
                  draggable: false,
                  scrollwheel: false,
                  mapTypeId:google.maps.MapTypeId.ROADMAP
              };

              map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
              marker.setMap(map);

              google.maps.event.addListener(marker, 'click', function() {

                infowindow.setContent(contentString);
                infowindow.open(map, marker);

              }); 
            };
            google.maps.event.addDomListener(window, 'load', initialize);

            google.maps.event.addDomListener(window, "resize", resizingMap());

            $('#myMapModal').on('show.bs.modal', function() {
               //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
               resizeMap();
            })

            function resizeMap() {
               if(typeof map =="undefined") return;
               setTimeout( function(){resizingMap();} , 400);
            }

            function resizingMap() {
               if(typeof map =="undefined") return;
               var center = map.getCenter();
               google.maps.event.trigger(map, "resize");
               map.setCenter(center); 
            }

            </script>


<body>

<div class="container">
        <div class="row">
            <div id="map-canvas"></div>
        </div>

    </div>
 
    <script type="text/javascript">
 
            var mapOptions = {
                zoom: 4,
                center: new google.maps.LatLng({{$items[0]->location}})
            }
            var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
 
 
            @foreach($items as $item)
                var marker{{$item->id}} = new google.maps.Marker({
                    position: new google.maps.LatLng({{$item->location}}),
                    map: map,
                    title: "{{$item->title}}"
                });
            @endforeach
 
 
    </script>


</body>


    </body>
    </html>