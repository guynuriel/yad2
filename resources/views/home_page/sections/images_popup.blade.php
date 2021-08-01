<style>
    
    .mySlides {
        display: none;
        justify-content: center;
        align-items: center;
    }

    .mySlides img,.mySlides video {
        vertical-align: middle;
        height: auto;
        width: auto;
        max-height: 400px;
        max-width: 500px;;
    }

    /* Slideshow container */
    .slideshow-container {
        width: 500px;
        height: 500px;
        position: relative;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -22px;
        color: white;
        font-weight: bold;
        font-size: 18px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        left: 0;
        border-radius: 3px 0 0 3px;
    }
    .prev {
        right: 0;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }


    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        bottom: 10px;
        right: 10px;
    }

    


    /* Fading animation */
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        -webkit-animation-fill-mode: forwards;          
        animation-name: fade;
        animation-duration: 1.5s;
        animation-fill-mode: forwards;          
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {

        .prev,
        .next,
        .text {
            font-size: 11px
        }
    }

</style>
<section id="images_popup">
    <div id="wrapper">
        <div id="container">
            <!-- Slideshow container -->
            <div class="slideshow-container">

                <!-- Full-width images with number and caption text -->
                
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
           
        </div>
    </div>
</section>

<script>
    var slideIndex = 1;

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        
        slides[slideIndex - 1].style.display = "flex";
        
    }
</script>
