<button id="myBtn">Click Me</button>

<p id="result"></p>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$("#myBtn").click(function(){

    $.ajax({
        url: "/get-message",
        type: "GET",
        success: function(response){
            $("#result").text(response.message);
        }
    });

});
</script>