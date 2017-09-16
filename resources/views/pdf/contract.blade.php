<html>
<head></head>
<body>
<script type="text/javascript" src="https://s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
<script>
    HelloSign.init("d88c4209bd93093d3815ef0e26069793");
    HelloSign.open({
        url: "https://app.hellosign.com/editor/embeddedSign?signature_id=559aa46cf6b9ab8bc4599862ee1f5b01&token=26c2c735bd5f318129b247cf1eb565ed",
        allowCancel: true,
        skipDomainVerification: true,
        messageListener: function(eventData) {
            // do something
        }
    });
</script>
</body>
</html>
