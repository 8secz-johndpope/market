<html>
<head></head>
<body>
<script type="text/javascript" src="https://s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
<script>
    HelloSign.init("d88c4209bd93093d3815ef0e26069793");
    HelloSign.open({
        url: "https://app.hellosign.com/editor/embeddedSign?signature_id=2712d7ecccc79d07d604d9b6389f162e&token=1910bcd2dd0cd125973224c1d1eea62b",
        allowCancel: true,
        skipDomainVerification: true,
        messageListener: function(eventData) {
            // do something
        }
    });
</script>
</body>
</html>
