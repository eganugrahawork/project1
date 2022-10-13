<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verified</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
       @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap");
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css");
*{
  margin:0;
  padding:0;
  font-family: "Poppins", sans-serif;
  box-sizing:border-box;
}
body{
  color:rgb(255,255,255);
  background-color:#1c1c25;
  font-size:1rem;
}
section{
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
  padding:2.5rem;
}
.card{
  position:relative;
}
.face::before,
.face::after,
.card::before,
.card::after{
  content:"";
  position:absolute;
  width:170px;
  height:170px;
  border-radius:50%;
  z-index:-2;
  display:block;
}
.face::before,
.card::before{
  bottom:75%;
  left:65%;
  background: linear-gradient(#f00, #f0f);
  animation:movepink 30s ease-in-out infinite;
  -moz-animation:movepink 30s ease-in-out infinite;
  -webkit-animation:movepink 30s ease-in-out infinite;
}
.face::after,
.card::after{
  top:75%;
  right:65%;
  background:linear-gradient(rgb(0,152,240), rgb(4,87,211));
  animation:moveblue 30s ease-in-out infinite;
  -moz-animation:moveblue 30s ease-in-out infinite;
  -webkit-animation:moveblue 30s ease-in-out infinite;
}

.face::before,
.face::after{
  filter:blur(6px);
  z-index:-1;
}
.face-inner::before{
  content: "";
  position: absolute;
  top: 0;
  left: 0px;
  bottom: 0;
  right: 0;
  box-shadow: inset 0 0 0 175px rgba(255,255,255,0.1);
  filter: blur(20px);
  z-index:-1;
}
.face{
  width:250px;
  height:auto;
  border-radius:20px;
  box-shadow:0 15px 35px rgba(0,0,0,0.5);
  background-color:rgba(255,255,255,0.05);
  border:0.1px solid rgba(255,255,255,0.425);
  position:relative;
  overflow:hidden;
  z-index:1;
  background-color:#1c1c25;
}
.face-inner{
  padding:1.25rem;
}

.btn{
  display:block;
  width:auto;
  padding:12px 20px;
  border-radius:20px;
  box-shadow:0 15px 35px rgba(0,0,0,0.5);
  background-color:rgba(255,255,255,0.5);
  text-align:center;
  margin:30px auto 0;
  cursor:pointer;
}
.face h3{
  font-weight:300;
  font-size:20px;
  text-align:center;
}
.face h4{
  font-weight:600;
  text-align:center;
  letter-spacing:1px;
}
.icon-content{
  display:flex;
  justify-content:space-around;
  margin:1.25rem auto;
}
.icon-content i{
  font-size:16px;
}
.icon-inner{
  text-align:center;
}
h4{
  font-weight:400;
  letter-spacing:0.5px;
}
a{
  color:currentColor;
}
p{
  display:inline-block;
}
@-webkit-keyframes moveblue{
  0% {top: 75%; right:65%;}
  50% {top: 30%;right:70%;}
  100% {top: 75%;right:65%;}
}
@-webkit-keyframes movepink{
  0% {bottom: 75%; left:65%;}
  50% {bottom: 50%;left:70%;}
  100% {bottom: 75%;left:65%;}
}
</style>
</head>
<body>
    <section>
        <div class="card">
          <div class="face">
            <div class=face-inner>
              <h3 style=" color:rgb(255,255,255);">Loccana</h3>
              <h4 style=" color:rgb(255,255,255);">{{ $data['title'] }}</h4>
              <div class="icon-content">
                <p style="color:rgb(255,255,255);">{{ $data['body'] }}</p>
              </div>
              <a href="{{ $data['url'] }}" class="btn" style="color:rgb(255,255,255);">
                <p style="color:rgb(255,255,255);">Verify</p>
              </a>
            </div>
          </div>
        </div>
      </section>

    </body>
</html>
