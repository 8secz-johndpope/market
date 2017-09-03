/**
 * Created by anil on 6/19/17.
 */
var albumBucketName = 'web.eu-central-1.sumra.net';
var bucketRegion = 'eu-central-1';
var IdentityPoolId = 'eu-central-1:860db8b5-a41e-4628-860d-7fa6823eb59c';


AWS.config.region = 'eu-central-1'; // Region
AWS.config.credentials = new AWS.CognitoIdentityCredentials({
    AccountId:'005279544259',
    IdentityPoolId: 'eu-central-1:9586b07e-a6bb-4078-8560-bcfd74e133b1',
    RoleArn:'arn:aws:iam::005279544259:role/Cognito_LastoneUnauth_Role'
});

AWS.config.credentials.get(function(err) {
    if (err) alert(err);
    console.log(AWS.config.credentials);
});

var bucketName = albumBucketName; // Enter your bucket name
var bucket = new AWS.S3({
    params: {
        Bucket: bucketName
    }
});

function upload_file() {
    var fileChooser = document.getElementById('file-chooser');
    var file = fileChooser.files[0];
    var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        var ext = file.name.split('.').pop();

        var objKey = '' + file.name;
        var uname = number+ext;
        console.log(uname);
        var params = {
            Key: uname,
            ContentType: file.type,
            Body: file,
            ACL: 'public-read'
        };

        bucket.putObject(params, function(err, data) {
            if (err) {
                console.log(err);
            } else {
                console.log(data);
                $(".row-images").prepend('<div class="col-sm-3"><img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/'+uname+'"></div>');

            }
        });
    } else {
       console.log("nothing to upload");
    }
}


