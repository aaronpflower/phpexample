<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport", content="width=device-width, initial-scale=1.0"></meta>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" >
        <link rel="stylesheet" href="./styles.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
        <title>PHP Weather App</title>
    </head>
    <body>
        <div class="mainContainer">
            <div id="locationStream" class="locationStream">
                
            </div>
            <div class="locationDetails">
                <h1 class="largeText">Try it out and enter a city!</h1>
                <form id="form" class="form">
                    <input class="formItem" type="text" name='address' placeholder="Enter City"/>
                    <input class="btn formItem" type="submit" value="Get Current Conditions"/>
                </form>
            </div>
        </div>
       <script src="./scripts.js"></script>
    </body>
</html>