<html>
<head></head>
<body>
<script type="text/javascript" src="https://s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
<script>
    HelloSign.init("d88c4209bd93093d3815ef0e26069793");
    HelloSign.open({
        url: "{{$url}}",
        allowCancel: true,
        messageListener: function(eventData) {
            // do something
        }
    });
</script>
</body>
</html>
