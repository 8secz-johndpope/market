
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

</head>
<body>

<input type="text" name="country" id="autocomplete"/>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://sumra.net/js/jquery.autocomplete.js"></script>
<script>
    $('#autocomplete').autocomplete({
        serviceUrl: '/api/suggest',
        onSelect: function (suggestion) {
            alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });
</script>
</body>
</html>
