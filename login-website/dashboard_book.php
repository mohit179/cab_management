<?php

session_start();
$conn = pg_connect("host=gserver.postgres.database.azure.com port=5432 dbname=postgres user=grahil password=DB_PASSWORD_HERE");
$username = $_SESSION['userid'];

if (!empty($_SESSION['start'])) {
    $sql = "select * from cards where user_email='" . $username[0] . "';";
    $query=pg_query($conn,$sql);
    $text="";

    while ($row = pg_fetch_array($query)) 
    {
        $text=$text."<option value=".$row['card_no'].">".$row['card_no']."</option>";
    }
    
    echo "
        <html>

<head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script defer
        src='https://maps.googleapis.com/maps/api/js?libraries=places&language=en&key=YOUR_API_KEY_HERE'
        type='text/javascript'></script>
    <link href='//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css' id='bootstrap-css' rel='stylesheet' />
    <link rel='stylesheet' href='dashboard.css'>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
</head>
<body> 
    <div style=' display :flex;'>
        <div style='background: #1398c8;
        background: -webkit-linear-gradient(to right, #0ebcf6, #64b6ec, #43aecf, #59bfde);
        background: linear-gradient(to right, #0ebcf6, #64b6ec, #43aecf, #59bfde);'>
            <h3 class='w3-bar-item' style='width:100% ;text-align:center; color:white;'>Welcome " . $username[1] . "</h3>
            <a href='dashboard_book.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;  color:white; margin-top:10px;'>Book Your Ride</a>
            <a href='dashboard_past.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center; color:white;'>View Past trips</a>
            <a href='addcard.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>Add Your Cards</a>
            <a href='viewcard.php' class='w3-bar-item w3-button'style='width:100% ;text-align:center;color:white;'>View All Cards</a>
            <a href='../logout.php' class='w3-bar-item w3-button' style='width:100% ;text-align:center;color:white;'>Logout</a>
        </div>
        <div id='container'>
            <div id='texty'>Book your ride</div>
            <div id=box1>
            <div class='forminputs'>
            <form id='distance_form' method='POST' action='confirm.php'>
                <div class='form-group' style='width: 90%;'><label>Enter The Pickup Point: </label> <input
                        class='form-control' id='from_places' placeholder='Enter a location' required /> <input
                        id='origin' name='origin' required='' type='hidden' /></div>

                <div class='form-group' style='width: 90%;'><label>Enter Destination: </label> 
                <input class='form-control' id='to_places' placeholder='Enter a location' required /> 
                <input id='destination' name='destination' required='' type='hidden' /></div>
                <input class='btn btn-primary' type='button' value='Calculate' />

                <div id='result' style='width:90% ; padding-top:10px;'>
                    <ul class='list-group'>
                        <li class='list-group-item d-flex justify-content-between align-items-center' id='dist'>
                            Distance is Kilometers:</li>
                        <input id='distance' name='distance' required='' type='hidden' />
                        <li class='list-group-item d-flex justify-content-between align-items-center' id='cost'>
                            Amount in Rs:</li>
                        <input id='amount' name='amount' required='' type='hidden' />
                    </ul>
                </div>
                <div style='display:flex;'>
                <label for='mode'>Choose Payment Mode</label>
                <select name='mode' id='mode' style='margin-left:10px;' required>
                <option value=''></option>
                <option value='cash on delivery'>cash</option>
                ".$text."
                </select>
                </div>
                <button class='btn btn-primary' style='background-color:brown;' id='submitbut' type='submit'
                    name='confirmride'>Confirm</button>
            </form>
        </div>
            </div>
        </div>
    </div>
    <script>
    $(function () {
        google.maps.event.addDomListener(window, 'load', function () {
            var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
            var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));

            google.maps.event.addListener(from_places, 'place_changed', function () {
                var from_place = from_places.getPlace();
                var from_address = from_place.formatted_address;
                $('#origin').val(from_address);
            });

            google.maps.event.addListener(to_places, 'place_changed', function () {
                var to_place = to_places.getPlace();
                var to_address = to_place.formatted_address;
                $('#destination').val(to_address);
            });

        });
        // calculate distance
        function calculateDistance() {
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            var service = new google.maps.DistanceMatrixService();
            service.getDistanceMatrix(
                {
                    origins: [origin],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                    // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                    avoidHighways: false,
                    avoidTolls: false
                }, callback);
        }
        // get distance results
        function callback(response, status) {
            if (status != google.maps.DistanceMatrixStatus.OK) {
                $('#result').html(err);
            } else {
                var origin = response.originAddresses[0];
                var destination = response.destinationAddresses[0];
                if (response.rows[0].elements[0].status === 'ZERO_RESULTS') {
                    $('#result').html('Better get on a plane. There are no roads between ' + origin + ' and ' + destination);
                } else {
                    var distance = response.rows[0].elements[0].distance;
                    var duration = response.rows[0].elements[0].duration;
                    console.log(response.rows[0].elements[0].distance);
                    var distance_in_kilo = distance.value / 1000; // the kilom
                    var distance_in_mile = distance.value / 1609.34; // the mile
                    var duration_text = duration.text;
                    var duration_value = duration.value;

                    $('#in_mile').text(distance_in_mile.toFixed(2));
                    $('#in_kilo').text(distance_in_kilo.toFixed(2));
                    $('#duration_text').text(duration_text);
                    $('#duration_value').text(duration_value);
                    $('#from').text(origin);
                    $('#to').text(destination);
                    document.getElementById('dist').innerText = 'Distance is Kilometers: ' +distance_in_kilo.toFixed(2) + ' km';
                    document.getElementById('cost').innerHTML = 'Amount in Rs:'+(distance_in_kilo.toFixed(2) * 6 + 10).toFixed(1) + ' Rs';
                    document.getElementById('distance').value = distance_in_mile.toFixed(2);
                    document.getElementById('amount').value = distance_in_mile.toFixed(2) * 6 + 10;
                }

            }
        }
        document.getElementById('distance_form').onkeypress = function (e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        }
        // print results on submit the form
        $('#distance_form').click(function (e) {
            calculateDistance();
        });

    });



</script>

</body>

</html>
        
        
        ";
    
} else {
    echo "<script>alert('Log in first');</script>";
    echo ("<script>window.location='index.html';</script>");
}
