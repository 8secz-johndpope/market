
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<style>
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
</head>
<body>

<input type="text" name="country" id="autocomplete"/>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://sumra.net/js/jquery.autocomplete.js"></script>
<script>
    $('#autocomplete').autocomplete({
        paramName :'q',
        serviceUrl: '/api/suggest',
        onSelect: function (suggestion) {
            alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });
</script>
</body>
</html>
