<script type="text/javascript">
    window.onload = function () {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://www.telize.com/jsonip?callback=DisplayIP";
        document.getElementsByTagName("head")[0].appendChild(script);
    };
    function DisplayIP(response) {
        document.getElementById("ipaddress").innerHTML = "Your IP Address is " + response.ip;
    }
</script>
<span id = "ipaddress"></span>