/**
 * Created by anil on 6/19/17.
 */
var albumBucketName = 'web.eu-central-1.sumra.net';
var cvBucketName = 'cv.eu-central-1.sumra.net';

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
var cv = new AWS.S3({
    params: {
        Bucket: cvBucketName
    }
});


function upload_file() {
    var fileChooser = document.getElementById('file-chooser');


    for (var i = 0; i < fileChooser.files.length; i++) {
        var file = fileChooser.files[i];
        var number = 1 + Math.floor(Math.random() * 999999999999);

    if (file) {
        console.log(file.name);
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
                $(".row-images").prepend('<div class="col-sm-3"><div class="cross-mark">X</div><input type="hidden" name="images[]" value="' + uname + '"><img src="https://s3.eu-central-1.amazonaws.com/web.eu-central-1.sumra.net/' + uname + '"></div>');
                //  $("#advert-form").append('<input type="hidden" name="images[]" value="'+uname+'">');

            }
        });
        })(uname);

    } else {
        console.log("nothing to upload");
    }
    }
}
function upload_cv() {
    var fileChooser = document.getElementById('upload-cv');


        var file = fileChooser.files[0];
        var number = 1 + Math.floor(Math.random() * 999999999999);

        if (file) {
            console.log(file.name);
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
            (function (uname) {

                cv.putObject(params, function (err, data) {
                    if (err) {
                        console.log(err);
                    } else {
                        console.log(data);
                        var title = $('#title').val();
                        var category=$('#category').val();
                        axios.get('/user/cvs/add', {
                            params: {file_name: uname,title:title,category:category}
                        })
                            .then(function (response) {
                                console.log(response);
                                location.reload();

                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                    }
                });
            })(uname);

        } else {
            console.log("nothing to upload");
        }

}


