/**
 * Created by anil on 6/19/17.
 */
var albumBucketName = $('#amazon-web-bucket').val();

var IdentityPoolId = $('#amazon-identity-pool-id').val();
var web_image_url = $('#amazon-web-bucket-url').val();

var awsregion = $('#amazon-region').val();
var cognito_role = $('#amazon-cognito-role').val();
var account_id = $('#amazon-account-id').val();

AWS.config.region = awsregion; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    AccountId:account_id,
    IdentityPoolId: IdentityPoolId,
    RoleArn:cognito_role
});

AWS.config.credentials.get(function(err) {
   // if (err) alert(err);
    console.log(AWS.config.credentials);
});

var bucketName = albumBucketName; // Enter your bucket name
var bucket = new AWS.S3({
    params: {
        Bucket: bucketName
    }
});

function upload_multi_file() {
    var fileChooser = document.getElementById('file-chooser-x');


    for (var i = 0; i < fileChooser.files.length; i++) {
        var file = fileChooser.files[i];
        var number = 1 + Math.floor(Math.random() * 999999999999);

        if (file) {
            var ext = file.name.split('.').pop();

            var objKey = '' + file.name;
            var uname = number + '.' + ext;
            console.log(uname);
            var params = {
                Key: uname,
                ContentType: file.type,
                Body: file,
                ACL: 'public-read'
            };

            console.log(params);
            (function (uname) {
            bucket.putObject(params, function (err, data) {
                if (err) {
                    console.log(err);
                } else {
                    console.log(data);
                    axios.get('/user/image/add', {
                        params: {image: uname}
                    })
                        .then(function (response) {
                            console.log(response);

                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    $(".row-images").prepend('<div class="multi-image"><div class="cross-mark">X</div><input type="hidden" name="images[]" value="' + uname + '"><img src="'+web_image_url+'/' + uname + '"></div>');
                    //  $("#advert-form").append('<input type="hidden" name="images[]" value="'+uname+'">');

                }
            });
            })(uname);
        } else {
            console.log("nothing to upload");
        }
    }
}



