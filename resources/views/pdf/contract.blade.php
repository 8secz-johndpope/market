<html>
<head></head>
<body>
<script type="text/javascript" src="https://s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
<script>
    HelloSign.init("d88c4209bd93093d3815ef0e26069793");
    HelloSign.open({
        url: "https://app.hellosign.com/editor/embeddedSign?signature_id=55de1db72f6ced0f1e21b9e797379043&token=07105d08cebe6a6cc705386d51c05bde",
        allowCancel: true,
        redirectUrl:"https://sumra.net",
        messageListener: function(eventData) {
            // do something
        }
    });
</script>
</body>
</html>
