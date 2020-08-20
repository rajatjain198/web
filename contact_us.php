<?php
        ob_start();
     include('header.php') ;
     ?>
     <?php
     require_once('mysqli_connect.php');
     require_once('./admin/functions.inc.php');
     $email="";
    $firstname="";
    $mobile="";
    $lastname="";
    $comment="";
    $added_on='';
        if(isset($_POST['submit'])){
            echo '<script>alert("Message Send!")</script>';
            $firstname = get_safe_value($con,$_POST['firstname']);
            $email = get_safe_value($con,$_POST['email']);
            $mobile = get_safe_value($con,$_POST['mobile']);
            $comment = get_safe_value($con,$_POST['comment']);
            $added_on=date('Y-m-d h:i:s');

            $sql="INSERT INTO contact_us(name,email,mobile,comment,added_on) values('$firstname','$email','$mobile','$comment','$added_on')";
            
            mysqli_query($con,$sql);
            
            header('location:contact_us.php');
           
            die();
        }
    ?>
 <!-- registration area -->
 <section id="register">
        <div class="row m-5">
            
                <div class="col-lg-4 offset-lg-2">
                <div class="text-center pb-5">
                    
                    <h1 class="login-title text-dark">CONTACT US</h1>
                    <p class="p-1 m-0 font-ubuntu text-black-50">Swing by for a Cup of Tea or Leave us a Message.</p>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="contact_us.php" method="post" enctype="multipart/form-data" id="reg-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text"  name="firstname" id="firstname" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col">
                                <input type="text"  name="lastname" id="lastname" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row my-4">
                            <div class="col">
                                <input type="mobile"  required name="mobile" id="mobile" class="form-control" placeholder="Mobile*">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <input type="email"  required name="email" id="email" class="form-control" placeholder="Email*">
                            </div>
                        </div>

                        <div class="form-row my-4">
                            <div class="col">
                                <textarea  name="comment" id="comment" class="form-control" placeholder="Comment"></textarea>
                            </div>
                        </div>
                        <div class="submit-btn text-center my-5">
                            <button type="submit" name='submit' class="btn btn-warning rounded-pill text-dark px-5">Send Message</button>

                        </div>


                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.1865631061187!2d75.90387348800081!3d22.721306081617065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962e2ce849c13ef%3A0x4f759a654cb06d01!2sBengali%20Square%2C%20Indore%2C%20Madhya%20Pradesh%20452016!5e0!3m2!1sen!2sin!4v1592864032880!5m2!1sen!2sin" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <div class="text-left pb-5">
            <h6 class="login-title text-dark"><i class="fas fa-map-marked-alt fa-2x">  Our Address</i> </h6>
            <p class="p-1 m-0 font-ubuntu text-black-50">Oswal Indoglobal Ventures G-1 Roopal Regency, Bangali Square,Indore</p>
            <hr>
            <h6 class="login-title text-dark"><Open class="fas fa-hourglass-half fa-2x">  Open Hours</i></h6>
            <p class="p-1 m-0 font-ubuntu text-black-50">24 X 7</p>
            <hr>
            <h6 class="login-title text-dark"><Phone class="fas fa-headset fa-2x">  Phone No.</i></h6>
            <p class="p-1 m-0 font-ubuntu text-black-50">9876543210</p>
                
        </div>
            </div>
                       
        </div>
    </section>
 

         <!-- Google Map js -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmGmeot5jcjdaJTvfCmQPfzeoG_pABeWo "></script>
    <script src="js/contact-map.js"></script>
    <script>
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 12,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(23.7286, 90.3854), // New York

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                 styles: 
        [ {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#141516"
                    },
                    {
                        "lightness": 17
                    }
                ]
            }
        ]
            };

            // Get the HTML DOM element that will contain your map 
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('googleMap');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.7286, 90.3854),
                map: map,
                title: 'Ramble!',
                icon: 'images/icons/map-2.png',
                animation:google.maps.Animation.BOUNCE

            });
        }
    </script>


<?php
include('footer.php');
?>